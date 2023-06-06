@extends('adminlte::page')

@section('content_header')
<h1>Vendedores</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark">
            Lista de vendedores
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h2>Filtros</h2>
                    <form action="{{route('vendedor.search')}}" method="get" enctype="multipart/form-data">
                        <div class="col">
                            <label for="name">Nome</label>
                            <input class="form-control" type="text" name="name" placeholder="Digite o nome do produto">
                        </div>
                        <div class="col">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Escolha uma opção...</option>
                                <option value="pen">Pendente</option>
                                <option value="apr">Aprovado</option>
                                <option value="rej">Rejeitado</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="credit">Créditos</label>
                            <input type="number" name="credit" id="credit" class="form-control" placeholder="0,00">
                        </div>
                        <div class="col mt-2">
                            <button type="submit" class="btn btn-dark">Aplicar filtros</button>
                        </div>
                    </form>
                    <div class="col mt-3">
                        <a href="{{route('vendedor.index')}}">Limpar filtros</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Créditos</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $vendedor)
                            <tr>
                                <td>{{$key++}}</td>
                                <td>{{$vendedor->user->name}}</td>
                                <td>{{isset($vendedor->credit) ? $vendedor->getCredit() : '0,00'}}</td>
                                <td>
                                    <p>{{ isset($vendedor->status) ? $vendedor->getStatus():'' }}</p>
                                    <a class=" btn btn-danger btn-sm " data-toggle="modal" data-target="#modaleditstatus" onclick="setusermodal({{$vendedor->id}})"><i class="fas fa-trash-alt"></i> Editar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  -->
<div class="modal fade" id="modaleditstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('vendedor.status')}}" method="post">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id_input" id="user_id_input">
                    <select class="form-control" name="status" id="status">
                        <option value="apr">Aprovar</option>
                        <option value="rej">Rejeitar</option>
                    </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    function setusermodal(data) {
        document.getElementById('user_id_input').value = data
        console.log(document.getElementById('user_id_input').value)
    }
</script>
@endsection