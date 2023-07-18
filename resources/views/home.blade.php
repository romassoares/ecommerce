@extends('adminlte::page')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header  bg-dark">
            <div class="d-flex justify-content-between">
                <h2>Produtos</h2>
                @can('user_ven',$user)
                <a class="btn btn-success" href="{{route('product.create')}}"><i class="fas fa-plus"></i></a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @if (isset($user->vendedor))
            @can('block_if_pending_or_rejected',$user->vendedor)
            <p>Sua conta está em análise. </p>
            @endcan
            @endif
            @can('view_products', $user)
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
                    <div class="flex-row">
                        @foreach ($products as $key => $product)
                        <a class="text-dark" href="{{route('product.show',['product_id'=>$product->id])}}">
                            <div class="card">
                                <div class="card-header">
                                    <div class="imgThumbmail">
                                        <img style="width:100%;" src="{{isset($product->imgs[0]->url)}}" alt="{{$product->nome}}" class="img-thumbnail">
                                    </div>
                                </div>
                                <div class="card-body">
                                    @can('if_user_admin',$user)
                                    <p><strong>Vendedor: </strong>{{$user->name}}</p>
                                    @endcan
                                    <p>{{$product->nome}}</p>
                                    <p>{{$product->descricao}}</p>
                                    <p>{{$product->getPreco()}}</p>
                                </div>
                                <div class="card-footer">
                                    @can('user_com',$user)
                                    <a href="{{route('compra.addItem',['product_id'=>$product->id])}}"><i class="fas fa-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endcan
        </div>
        <div class="card-footer">
            @can('view_products', $user)
            {{$products->links()}}
            @endcan
        </div>
    </div>
</div>

@stop