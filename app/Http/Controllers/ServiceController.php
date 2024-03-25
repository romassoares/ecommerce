<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    private $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $services = $this->service->all();
        return view('agenda.service.index', compact('services'));
    }

    public function create()
    {
        $days = $this->service->get_days_of_week();
        return view('agenda.service.form', compact('days'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|min:3|max:150|string|unique:services',
            'limit_schedule' => 'required|numeric',
            'service_day' => 'required',
            'price' => 'required',
        ]);
        if ($validated) {
            $save = $this->service->create([
                'description' => $validated['description'],
                'limit_schedule' => $validated['limit_schedule'],
                'service_day' => json_encode($validated['service_day']),
                'price' => $validated['price'],
            ]);
            if ($save) {
                return redirect()->route('service.index')->with('msg', 'item saved successed');
            } else {
                return redirect()->back()->with('msg', 'saving error');
            }
        } else {
            return redirect()->back()->with('msg', 'validation error');
        }
    }

    public function service_days_allowed($id)
    {
        $service = $this->service->find($id);
        if (isset($service)) {
            $schedules_by_day = DB::table('services as srv')
                ->select('sch.date_schedule',  DB::raw('count(sch.service_id) as tot_srv'))
                ->join('schedules as sch', 'sch.service_id', 'srv.id')
                ->where('sch.service_id', $service->id)
                ->groupBy('sch.date_schedule')
                ->get();
            // dd($schedules_by_day);
            return ['dayWeek' => json_decode($service->service_day), 'scheduleDay' => $schedules_by_day];
        }
        return;
    }
}
