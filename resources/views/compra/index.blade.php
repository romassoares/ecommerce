@extends('adminlte::page')

@section('content_header')
<h1>Carrinho de compras</h1>
@stop
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            <h2>carrinho</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h2>Filtros</h2>
                    <form action="{{route('product.search')}}" method="get" enctype="multipart/form-data">
                        <div class="col">
                            <label for="name">Nome</label>
                            <input class="form-control" type="text" name="name" placeholder="Digite o nome do produto">
                        </div>
                        <div class="col">
                            <label for="preco">Preço</label>
                            <select class="form-control" name="preco" id="preco">
                                <option disabled selected value="">Escolha uma opção...</option>
                                <option value="men">Menor preço</option>
                                <option value="mai">Maior preço</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="categoria">Categoria</label>
                            <select class="form-control" name="categoria" id="categoria">
                                <option disabled selected value="">Escolha uma opção...</option>
                                @forelse ($categorias as $categoria)
                                <option value="{{$categoria->categoria}}">{{$categoria->categoria}}</option>
                                @empty
                                'Nenhuma categoria cadastrada'
                                @endforelse
                            </select>
                        </div>
                        <div class="col mt-2">
                            <button type="submit" class="btn btn-dark">Aplicar filtros</button>
                        </div>
                    </form>
                    <div class="col mt-3">
                        <a href="{{route('home')}}">Limpar filtros</a>
                    </div>
                </div>
                <div class="col-md-9">
                    campos
                </div>
            </div>
        </div>
    </div>
</div>
@stop