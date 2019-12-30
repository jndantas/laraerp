@extends('layouts.master')

@section('title')
Desenvolvedor
@stop

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Desenvolvedor</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Desenvolvedor</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div id="app">
<developer></developer>
<vue-progress-bar></vue-progress-bar>
</div>
@endsection
