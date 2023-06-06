@extends('adminlte::page')

@section('content_header')
<h1>Produto</h1>
@stop
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            <h2>Produto</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex justify-content-around">
                        @if ($product)
                        @foreach ($product->imgs as $img)
                        <div class="card" style="max-width: 100px;height:100%">
                            <div class="">
                                <img style="max-width:100px;" src="{{url("storage/{$img->url}")}}" alt="{{$product->nome}}">
                            </div>
                            @can('user_com')
                            <div class="card-footer">
                                <a href="{{route('product.imgRemove',['img_id'=>$img->id,'product_id'=>$product->id])}}" class="text-danger"><i class="fas fa-trash"></i></a>
                            </div>
                            @endcan
                        </div>
                        @endforeach
                        @endif
                    </div>
                    @can('user_com')
                    <form action="{{route('product.img', ['product_id'=>$product->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="img" id="img">
                        <button class="btn btn-success" type="submit">Salvar</button>
                    </form>
                    @endcan
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <h2>{{$product->nome}}</h2>
                    </div>
                    <div class="row">
                        <p>{{$product->descricao}}</p>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>{{$product->categoria}}</p>
                            <p class="text-success font-weight-bold">{{$product->getPreco()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop