@extends('adminlte::page')

@section('content_header')
<h1>Shopping</h1>
@stop
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            <h2>Shopping</h2>
        </div>
        <div class="card-body">
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
                                <option value="men">lowert price</option>
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
                                'no category registered'
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
                <div class="col-md-9">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>R$</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compras as $key => $item)
                            <tr>
                                <td>{{$key++}}</td>
                                <td>{{isset($item->user) ? $item->user->name : $item->name}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->preco ? $item->preco:$item->getPreco()}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop