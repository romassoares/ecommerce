@extends('adminlte::page')

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
                        <div class="form-group col">
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
                        <div class="form-group col">
                            <label for="service_id">service_id</label>
                            <select class="form-control" name="service_id" id="service_id">
                                @foreach ($services as $service )
                                <option value="{{$service->id}}">{{$service->description}}</option>
                                @endforeach
                            </select>
                            @error('service_id')
                            <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="date_schedule">date_schedule</label>
                            <input type="date" name="date_schedule" id="date_schedule" class="form-control @error('date_schedule') is-invalid @enderror" placeholder="date_schedule" value="{{isset($schedule) ? $schedule->date_schedule : old('date_schedule')}}">
                            @error('date_schedule')
                            <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <button type="submit">save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  -->

@stop

@section('js')
<script>
</script>
@endsection