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
                <form action="{{route('client.store')}}" method="post">
                    @csrf
                    <div class="d-flex">
                        <div class="form-group col">
                            <label for="name">name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="name" value="{{isset($client) ? $client->name : old('name')}}">
                            @error('name')
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