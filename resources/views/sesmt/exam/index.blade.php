@extends('layouts.master')

@section('title')
Lista de Exames
@stop

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Exames</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Exames</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div id="app">
<sesmt-exam></sesmt-exam>
<vue-progress-bar></vue-progress-bar>
</div>
@endsection
