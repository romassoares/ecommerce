@extends('adminlte::page')

@section('content_header')

<h1 id="diretory"></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            service form
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{route('service.store')}}" method="post">
                    @csrf
                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="description">description</label>
                            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="description" value="{{isset($service) ? $service->description : old('description')}}">
                            @error('description')
                            <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="limit_schedule">limit_schedule</label>
                            <input type="number" name="limit_schedule" id="limit_schedule" class="form-control @error('limit_schedule') is-invalid @enderror" placeholder="limit_schedule" value="{{isset($service) ? $service->price : old('limit_schedule')}}">
                            @error('limit_schedule')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="service_day">service_day</label>
                            <select class="form-control @error('service_day') is-invalid @enderror" name="service_day[]" id="service_day" multiple>
                                @foreach ($days as $day )
                                <option value="{{$day}}">{{$day}}</option>
                                @endforeach
                            </select>
                            @error('service_day')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="price">price</label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="price" value="{{isset($service) ? $service->price : old('price')}}">
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
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