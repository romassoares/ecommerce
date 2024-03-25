<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\ServiceSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    private $schedule;
    private $service;
    public function __construct(Schedule $schedule, Service $service)
    {
        $this->schedule = $schedule;
        $this->service = $service;
    }
    public function index()
    {
        $schedules = $this->schedule->all();
        return view('agenda.schedule.index', compact('schedules'));
    }

    public function create()
    {
        $clients = Client::all();
        $services =  DB::table('services as srv')
            ->select('srv.*', DB::raw('IFNULL(count(sch.id), 0) as tot_services'))
            ->leftJoin('schedules as sch', function ($join) {
                $join->on('sch.service_id', '=', 'srv.id')
                    ->whereRaw('DATE(sch.date_schedule) = DATE(NOW())');
            })
            ->where(function ($query) {
                $query->orWhereNull('sch.id');
            })
            ->orWhere(function ($query) {
                $query->where('sch.date_schedule', '>=', DB::raw('DATE_ADD(DATE(NOW()), INTERVAL 1 DAY)'));
            })
            ->groupBy('srv.id')
            ->havingRaw('tot_services < srv.limit_schedule')
            ->get();
        $daysweek = $this->service->get_days_of_week();
        return view('agenda.schedule.form', compact('clients', 'services', 'daysweek'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required',
            'date_schedule' => 'required|date',
            'service_id' => 'required'
        ]);
        if (!$validated)
            return redirect()->back();

        $create = $this->schedule->create([
            'client_id' => $validated['client_id'],
            'date_schedule' => $validated['date_schedule'],
            'service_id' => $validated['service_id']
        ]);
        if ($create) {
            return redirect()->route('schedule.show', ['schedule_id' => $create->id])->with('msg', 'item saved successed');
        } else {
            return redirect()->back()->with('msg', 'saving error');
        }
    }

    public function show($schedule_id)
    {
        $schedule = $this->schedule->find($schedule_id);
        return view('agenda.schedule.show', compact('schedule'));
    }
}
