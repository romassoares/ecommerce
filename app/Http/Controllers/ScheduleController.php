<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\ServiceSchedule;
use Illuminate\Http\Request;

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
        $services =  $this->service->all();
        return view('agenda.schedule.form', compact('clients', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required',
            'date_schedule' => 'required|date',
        ]);
        if (!$validated)
            return redirect()->back();

        $create = $this->schedule->create([
            'client_id' => $validated['client_id'],
            'date_schedule' => $validated['date_schedule']
        ]);
        if ($create) {
            return redirect()->route('schedule.add_service', ['schedule_id' => $create->id])->with('msg', 'item saved successed');
        } else {
            return redirect()->back()->with('msg', 'saving error');
        }
    }

    public function add_service($schedule_id)
    {
        $schedule = $this->schedule->find($schedule_id);
        $services = Service::all();
        return view('agenda.schedule.addService', compact('schedule', 'services'));
    }

    public function addServiceStore(Request $request)
    {
        dd('asdfa');
        // $validated = $request->validate([
        //     "schedule_id" => 'required|unique:schedules,id',
        //     "service_id" => 'required',
        //     "price" => 'required',
        //     "amount" => 'required',
        // ]);

        // $if_qnt_service_allowed = ServiceSchedule::qnt_service_allowed($validated);

        // if ($if_qnt_service_allowed == 0)
        //     return redirect()->back()->with('msg', 'limit exceeded');

        // $create = $this->service_schedule->create([
        //     "schedule_id" => $request['schedule_id'],
        //     "service_id" => $request['service_id'],
        //     "price" => $request['price'],
        //     "amount" => $request['amount'],
        // ]);
        // if ($create) {
        //     return redirect()->route('schedule.show', ['schedule_id' => $create->id])->with('msg', 'item saved successed');
        // } else {
        //     return redirect()->back()->with('msg', 'saving error');
        // }
    }

    public function show($schedule_id)
    {
        $schedule = $this->schedule->find($schedule_id);
        return view('agenda.schedule.show', compact('schedule'));
    }
}
