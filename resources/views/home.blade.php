@extends('adminlte::page')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Produtos</h2>
        </div>
        <div class="card-body">
            @if (isset($user->vendedor))
            @can('block_if_pending_or_rejected',$user->vendedor)
            <p>Sua conta está em análise. </p>
            @endcan
            @endif
            @can('view_products', $user)
            @foreach ($products as $key => $product)
            <div class="d-flex justify-content-around">
                <div class="col-md-4 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            @foreach ($product->imgs as $img)
                            <img style="width:200px" src="{{$img->url}}" alt="{{$product->nome}}" class="img-thumbnail">
                            @endforeach
                        </div>
                        <div class="card-body">
                            <p>{{$product->nome}}</p>
                            <p>{{$product->descricao}}</p>
                            <p>{{$product->price}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endcan
        </div>
        <div class="card-footer">
            {{$products->links()}}
        </div>
    </div>
</div>

@stop