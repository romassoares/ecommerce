@extends('adminlte::page')

@section('content_header')

<h1 id="diretory"></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            shedule showing
        </div>
        <div class="card-body">
            <div class="row">

                @if (isset($schedule))
                <div>
                    <strong>Client:</strong> <span>{{$schedule->client->name}}</span>
                </div>
                <div>
                    <strong>Data:</strong> <span>{{$schedule->date_schedule}}</span>
                </div>
                <div>
                    <strong>services:</strong><span>{{$schedule->service->description}}</span>
                </div>
                @endif

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