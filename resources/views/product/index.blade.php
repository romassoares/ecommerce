@extends('adminlte::page')
@section('content_header')
<h1>Produtos</h1>
@stop
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            <div class="row">
                Lista dos produtos cadastrados
            </div>
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
                        <a href="{{route('product.index')}}">Limpar filtros</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$product->nome}}</td>
                                <td>{{$product->categoria}}</td>
                                <td>{{$product->getpreco()}}</td>
                                <td>
                                    <div class="col d-flex justify-content-around">
                                        <a href="{{route('product.show',['product_id'=>$product->id])}}"><i class="fas fa-eye"></i></a>
                                        <a class="text-warning" href="{{route('product.edit',['product_id'=>$product->id])}}"><i class="fas fa-edit"></i></a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$products->links()}}
                </div>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

@stop