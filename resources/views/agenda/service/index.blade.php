@extends('adminlte::page')

@section('content_header')

<h1 id="diretory"></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            service list
        </div>
        <div class="card-body">
            <div class="row">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>description</th>
                        <th>limit_schedule</th>
                        <th>service_day</th>
                        <th>price</th>
                    </tr>
                    @if (isset($services))
                    @foreach ($services as $service )
                    <tr>
                        <td>{{$service->id}}</td>
                        <td>{{$service->description}}</td>
                        <td>{{$service->limit_schedule}}</td>
                        <td>{{$service->service_day}}</td>
                        <td>{{$service->price}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>no registered service</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{route('service.create')}}">new</a>
        </div>
    </div>
</div>

<!--  -->

@stop

@section('js')
<script>
</script>
@endsection