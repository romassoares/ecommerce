@extends('adminlte::page')

@section('content_header')
<h1>My cart</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            <h2>added itens</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>R$</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itens as $key => $item)
                    <tr>
                        <td>{{$key++}}</td>
                        <td>{{$item->nome}}</td>
                        <td>{{$item->getPreco()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{route('compra.finalizar',['user_id'=>Auth::id()])}}">Purchase</a>
        </div>
    </div>
</div>
@stop