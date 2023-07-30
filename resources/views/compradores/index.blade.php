@extends('adminlte::page')

@section('content_header')
<h1>Buyers</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            Buyers list
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h2>Filters</h2>
                    <form action="{{route('comprador.search')}}" method="get" enctype="multipart/form-data">
                        <div class="col">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter product name">
                        </div>
                        <div class="col">
                            <label for="data_nasc">Date of birth</label>
                            <input class="form-control" type="date" name="data_nasc" placeholder="enter date of birth">
                        </div>
                        <div class="col">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="000.000.000-00">
                        </div>
                        <div class="col">
                            <label for="estado">state</label>
                            <select class="form-control" name="estado" id="estado">
                                @forelse ($ufs as $uf)
                                <option value="{{$uf->sigla}}">{{$uf->nome}}</option>
                                @empty
                                'Error fetching states, try again'
                                @endforelse
                            </select>
                        </div>
                        <div class="col">
                            <label for="credit">Credits</label>
                            <input type="number" name="credit" id="credit" class="form-control" placeholder="0,00">
                        </div>
                        <div class="col mt-2">
                            <button type="submit" class="btn btn-dark">Apply filters</button>
                        </div>
                    </form>
                    <div class="col mt-3">
                        <a href="{{route('comprador.index')}}">Limpar filtros</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>date of birth</th>
                                <th>CPF</th>
                                <th>state</th>
                                <th>credits</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compradores as $key => $comprador)
                            <tr>
                                <td>{{$key++}}</td>
                                <td>{{$comprador->user->name}}</td>
                                <td>{{$comprador->getNascimento()}}</td>
                                <td>{{$comprador->getCpf()}}</td>
                                <td>{{$comprador->state}}</td>
                                <td>{{$comprador->getCredit()}}</td>
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