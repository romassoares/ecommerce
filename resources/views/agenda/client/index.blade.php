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
                    </tr>
                    @if (isset($clients))
                    @foreach ($clients as $client )
                    <tr>
                        <td>{{$client->id}}</td>
                        <td>{{$client->name}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>no registered client</td>
                    </tr>
                    @endif
                </table>
            </div>
            <a href="{{route('client.create')}}">new</a>
        </div>
    </div>
</div>

<!--  -->

@stop

@section('js')
<script>
</script>
@endsection