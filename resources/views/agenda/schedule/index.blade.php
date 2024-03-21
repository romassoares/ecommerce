@extends('adminlte::page')

@section('content_header')

<h1 id="diretory"></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            Lista de vendedores
        </div>
        <div class="card-body">
            <div class="row">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>description</th>
                        <th>date_schedule</th>
                    </tr>
                    @if (isset($schedules))
                    @foreach ($schedules as $schedule )
                    <tr>
                        <td>{{$schedule->id}}</td>
                        <td>{{$schedule->client->name}}</td>
                        <td>{{$schedule->date_schedule}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>no registered Schedule</td>
                    </tr>
                    @endif
                </table>
            </div>
            <a href="{{route('schedule.create')}}">new</a>
        </div>
    </div>
</div>

<!--  -->

@stop

@section('js')
<script>
</script>
@endsection