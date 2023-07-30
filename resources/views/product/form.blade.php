@extends('adminlte::page')
@section('content_header')
<h1>Produto</h1>
@stop
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            <h2>{{isset($product) ? 'update' : 'create'}} product</h2>
        </div>
        <div class="card-body">
            @if(isset($product))
            <form action="{{route('product.update',['product_id'=>$product->id])}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @else
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" placeholder="nome do produto" class="form-control @error('nome') is-invalid @enderror" value="{{$product->nome ?? old('nome')}}">
                                @error('nome')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <input type="text" name="descricao" id="descricao" placeholder="descrição do produto" class="form-control @error('descricao') is-invalid @enderror" value="{{$product->descricao ?? old('descricao')}}">
                                @error('descricao')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="preco">Preço</label>
                                <input type="number" name="preco" id="preco" class="form-control @error('preco') is-invalid @enderror" value="{{$product->preco ?? old('preco')}}">
                                @error('preco')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <input type="text" name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" placeholder="categoria do produto" value="{{$product->categoria ?? old('categoria')}}">
                                @error('categoria')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </form>
        </div>
    </div>
</div>
@stop