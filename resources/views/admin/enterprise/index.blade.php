@extends('layouts.master')

@section('title')
Lista de Empresas
@stop

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Empresas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Empresas</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">Empresas</h3>
            <div class="card-tools">
                <span data-toggle="tooltip" title="Adicionar Categoria" data-container="body">
                    <a href="#" data-toggle="modal" data-target=".modalcadastro"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                </span>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="table">
                <thead>
                    <tr class="filters">
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Razão Social</th>
                        <th>CNPJ</th>
                        <th>Qntd Funcionarios</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($enterprises) && count($enterprises) > 0 )
                @foreach($enterprises as $enterprise)
                    <tr>
                        <td>{{ $enterprise->id }}</td>
                        <td>{{ $enterprise->name }}</td>
                        <td>{{ $enterprise->title }}</td>
                        <td>{{ $enterprise->document_number }}</td>
                        <td>1</td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="{{ route('empresas.edit', $enterprise->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>
                                <a class="btn btn-danger btn-sm"
                                onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete').submit();}"><i class="fas fa-trash"></i>Excluir</a>
                            <form id="form-delete"style="display: none" action="{{ route('empresas.destroy',['empresa' => $enterprise->id]) }}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
</section>

@include('admin/enterprise/create')

@endsection


@section('js')
<script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
@endsection
