@extends('layouts.master')

@section('title')
Lista de Produtos
@stop

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Produtos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Produtos</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="container" id="app">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Entrada: {{$product->name}}</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Minimizar">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Fechar">
            <i class="fas fa-times"></i></button>
        </div>
        </div>
        <form action="{{route('storeInput')}}" method="POST">
            {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Tamanho</span>
                                    <span class="info-box-number text-center text-muted mb-0">{{$product->measure}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Saldo</span>
                                    <span class="info-box-number text-center text-muted mb-0">{{$product->stock}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Categoria</span>
                                    <span class="info-box-number text-center text-muted mb-0">{{$product->category->name}} </span>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    <!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nota Fiscal:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="document_number">
                            </div>
                            <!-- /.input group -->
                        </div>

                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Data da Entrada:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker" id="datepicker" name="date" value="{{now()}}">
                            </div>
                            <!-- /.input group -->
                        </div>

                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4" data-select2-id="29">
                        <div class="form-group">
                            <label>CA: </label>
                            <select class="form-control select2" name="authorization_certificate_id" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @foreach ($certificates as $c)
                                <option data-select2-id="{{ $c->id}}" value="{{ $c->id}}" >{{ $c->document_number}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Valor:</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-money-bill-alt"></i>
                                        </span>
                                    </div>
                                <input type="text" class="form-control" name="value">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>

                    <!-- /.form-group -->
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Quantidade:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control" name="qntd" min="0">
                            </div>
                            <!-- /.input group -->
                        </div>

                    <!-- /.form-group -->
                    </div>

                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>

        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Cancelar</button>
            <button type="submit" class="btn btn-info">Salvar</button>
        </div>
    </form>
</section>
@endsection


