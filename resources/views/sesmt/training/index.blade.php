@extends('layouts.master')

@section('title')
Lista de Treinamentos
@stop

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Treinamentos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Treinamentos</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div id="app">
<sesmt-training></sesmt-training>
<vue-progress-bar></vue-progress-bar>
</div>
@endsection
