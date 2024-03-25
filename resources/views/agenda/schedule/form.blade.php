@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .event {
        position: absolute;
        width: 4px;
        height: 4px;
        border-radius: 150px;
        bottom: 3px;
        left: calc(50% - 1.5px);
        content: " ";
        display: block;
        background: #3d8eb9;
        font-size: 6px;
    }

    .event.busy {
        background: #f64747;
    }
</style>
@endsection

@section('content_header')

<h1 id="diretory"></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            schedule form
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{route('schedule.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="client_id">client_id</label>
                            <select class="form-control" name="client_id" id="client_id">
                                @foreach ($clients as $client )
                                <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                            @error('client_id')
                            <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="service_id">service_id</label>
                            <select class="form-control select2" name="service_id" id="service_id">
                                <option value="" disabled>choose an service</option>
                                @foreach ($services as $service )
                                <option value="{{$service->id}}">{{$service->description}}</option>
                                @endforeach
                            </select>
                            @error('service_id')
                            <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date_schedule">date_schedule</label>
                            <input type="date" name="date_schedule" id="date_schedule" class="form-control @error('date_schedule') is-invalid @enderror" placeholder="date_schedule" value="{{isset($schedule) ? $schedule->date_schedule : old('date_schedule')}}">
                            @error('date_schedule')
                            <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <button class="btn btn-success" type="submit">save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let service_input = document.querySelector('#service_id')
    const myInput = document.querySelector("#date_schedule");

    const daysweek = @json($daysweek)

    function days_from_disable(days) {
        return function(date) {
            const indexes = days.map(day => daysweek.indexOf(day))
            const dayOfWeek = date.getDay();
            const isDisabledDay = !indexes.includes(dayOfWeek);
            return (dayOfWeek === 0 || dayOfWeek === 6) || isDisabledDay;
        };
    }

    function change_input_date_with_dates_allowed(allowedDaysofWeek) {
        const date = new Date
        flatpickr(myInput, {
            minDate: "today",
            disable: [days_from_disable(allowedDaysofWeek.dayWeek)],
            dateFormat: "Y-m-d",
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                allowedDaysofWeek.scheduleDay.forEach(scheduleDay => {
                    var date = dayElem.dateObj.toISOString().slice(0, 10);

                    if (scheduleDay.date_schedule && scheduleDay.date_schedule.includes(date)) {
                        dayElem.innerHTML += '<span class="event busy">' + scheduleDay.tot_srv + '</span>';
                    }
                });
            }
        });
    }

    async function getData(option) {
        const response = await fetch('/service/service_days_allowed/' + option);
        const data = await response.json();
        change_input_date_with_dates_allowed(data)
    }

    service_input.addEventListener('change', function() {
        let selectedIndex = service_input.selectedIndex
        let option = service_input.options[selectedIndex].value
        getData(option)
    })
</script>
@endsection