@extends('adminlte::page')

@section('content_header')
<h1>Perfil, {{$user->name}}</h1>
@stop
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Editar dados do {{$user->getType()}}
        </div>
        <div class="card-body">
            <form action="{{route('profile.store',['user_id'=>$user->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-success">salvar</button>
            </form>
        </div>
    </div>
</div>
@stop