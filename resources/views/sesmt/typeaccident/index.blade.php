@extends('layouts.master')

@section('title')
Lista de Tipos de Acidentes
@stop

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tipos de Acidentes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Tipos de Acidentes</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div id="app">
<sesmt-typeaccident></sesmt-typeaccident>
<vue-progress-bar></vue-progress-bar>
</div>
@endsection
