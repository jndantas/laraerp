@extends('layouts.master')

@section('titulo')
Lista de Categorias
@stop

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Categorias</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Categorias</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="card-header">
            <h3 class="card-title">Categorias</h3>
            <div class="card-tools">
                <span data-toggle="tooltip" title="Adicionar Categoria" data-container="body">
                    <a href="#" data-toggle="modal" data-target=".modalcadastro"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped categorias" id="table">
                <thead>
                    <tr>
                        <th style="width: 10%">
                            #
                        </th>
                        <th style="width: 40%">
                            Nome
                        </th>
                        <th style="width: 10%">
                            N° de EPI's
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($categorias) && count($categorias) > 0 )
		            @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nome }}</td>
                        <td>1</td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="{{ route('categorias.edit', $categoria->id) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Editar
                            </a>
                                <a class="btn btn-danger btn-sm" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Apagar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</section>
@include('admin/categoria/create')

@endsection

@section('js')

<script type="text/javascript" src="{{ asset('js/tables.js') }}"></script>

@stop
