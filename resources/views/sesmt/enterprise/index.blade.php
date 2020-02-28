@extends('layouts.master')

@section('title')
Lista de Funcionários
@stop

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cadastro</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Cadastro</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div id="app">
        <sesmt-enterprise></sesmt-enterprise>
        <sesmt-sector></sesmt-sector>
        <sesmt-position></sesmt-position>
        <vue-progress-bar></vue-progress-bar>
</div>

@endsection
