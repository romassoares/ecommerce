@extends('adminlte::page')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header  bg-dark">
            <div class="d-flex justify-content-between">
                <h2>Products</h2>
                @can('user_ven',$user)
                <a class="btn btn-success" href="{{route('product.create')}}"><i class="fas fa-plus"></i></a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @if (isset($user->vendedor))
            @can('block_if_pending_or_rejected',$user->vendedor)
            <p>your account is under review. </p>
            @endcan
            @endif
            @can('view_products', $user)
            <div class="row">
                <div class="col-md-3">
                    <h2>Filters</h2>
                    <form action="{{route('product.search')}}" method="get" enctype="multipart/form-data">
                        <div class="col">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter product name">
                        </div>
                        <div class="col">
                            <label for="preco">Price</label>
                            <select class="form-control" name="preco" id="preco">
                                <option disabled selected value="">choose an option...</option>
                                <option value="men">lowest price</option>
                                <option value="mai">highest price</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="categoria">Category</label>
                            <select class="form-control" name="categoria" id="categoria">
                                <option disabled selected value="">choose an option...</option>
                                @forelse ($categorias as $categoria)
                                <option value="{{$categoria->categoria}}">{{$categoria->categoria}}</option>
                                @empty
                                'no categatory registered'
                                @endforelse
                            </select>
                        </div>
                        <div class="col mt-2">
                            <button type="submit" class="btn btn-dark">apply filters</button>
                        </div>
                    </form>
                    <div class="col mt-3">
                        <a href="{{route('home')}}">clear filters</a>
                    </div>
                </div>
                <div class="col-md-9 d-flex flex-wrap">
                    <table class="table">
                        @foreach ($products as $key => $product)
                        <tr>
                            <td>
                                <!-- <a href="{{route('product.show',['product_id'=>$product->id])}}"> -->
                                <img style="background-size: contain; background-repeat: no-repeat; max-width:200px; max-height:200px" src="{{asset($product->imgs[0]->url)}}" alt="{{$product->nome}}" class="">
                                <!-- </a> -->
                            </td>
                            <td>
                                @can('if_user_admin',$user)
                                <p><strong>Vendedor: </strong>{{$product->user->name}}</p>
                                @endcan
                                <p>{{$product->nome}}</p>
                                <p>{{$product->descricao}}</p>
                                <p>{{$product->getPreco()}}</p>
                            </td>
                            <td>
                                @can('user_com',$user)
                                <a href="{{route('compra.addItem',['product_id'=>$product->id])}}"><i class="fas fa-plus"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </table>
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