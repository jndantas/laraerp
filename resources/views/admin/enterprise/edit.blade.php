@extends('layouts.master')

@section('title')
Editar Categoria
@stop

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categorias</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Editar Categoria</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
                {{$category->name}}
            </div>
            <div class="card-body">
                <form method="post" class="form-horizontal" action="{{ route('categories.update',$category->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="slug" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="id" id="id" value="{{$category->id}}"  readonly  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug" class="col-sm-2 control-label">Nome</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{route('categories.index')}}">
                            Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                            Alterar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</section>


@stop
