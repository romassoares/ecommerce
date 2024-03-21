@extends('adminlte::page')

@section('content_header')

<h1 id="diretory"></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            addService form
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{route('schedule.addServiceStore',['schedule_id'=>$schedule->id])}}" method="post">
                    @csrf
                    <input type="hidden" name="schedule_id" value="{{$schedule->id}}">
                    <div class="row">
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
                            <label for="price">price</label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="price" value="{{isset($schedule) ? $schedule->price : old('price')}}">
                            @error('price')
                            <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="amount">amount</label>
                            <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="amount" value="{{isset($schedule) ? $schedule->amount : old('amount')}}">
                            @error('amount')
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