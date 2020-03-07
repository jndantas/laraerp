@extends('layouts.master')

@section('title')
{{ isset($category) ? 'Editar Funcionário' : 'Novo Funcionário'}}
@stop

@section('content')


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ isset($category) ? 'Editar Funcionário' : 'Novo Funcionário'}}</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Funcionários</a></li>
                    <li class="breadcrumb-item active">{{ isset($category) ? 'Editar Funcionário' : 'Novo Funcionário'}}</li>
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
    <div class="row justify-content-md-center">
        <div class="col-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title float-right"><i class="fas fa-2x fa-user-tie"></i></h3>
                </div>
                <form action="{{ isset($employee) ? route('employee.update', $employee->id) : route('employee.store') }}" method="post" enctype="multipart/form-data">
                    @if (isset($employee))
                        @method('PUT')
                    @endif
                    <div class="row flex-lg-nowrap">
                        <div class="col">
                            <div class="row">
                            <div class="col mb-3">
                                <div class="card-body">
                                    <div class="e-profile">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 140px;">
                                            <div class="d-flex justify-content-center align-items-center rounded">
                                                <img src="{{ asset('img/garoto.png') }}" alt="..." class="avatar img-thumbnail">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                            <div class="mt-2">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fa fa-fw fa-camera"></i>
                                                <span>Trocar foto</span>
                                                <input type="file" name="avatar" id="file" class="customFile file-upload">
                                            </button>
                                            </div>
                                        </div>

                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="" class="active nav-link">Dados</a></li>
                                    </ul>
                                    <div class="tab-content pt-3">
                                        <div class="tab-pane active">
                                            <div class="form-row">
                                                <div class="form-group col-md-2">
                                                    <label>Data de admissão</label>
                                                    <input class="form-control" type="date" name="admission" placeholder="John Smith" value="{{ isset($employee) ? $employee->admission: '' }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="red">Data de demissão</label>
                                                    <input class="form-control" type="date" name="admission" placeholder="John Smith" value="{{ isset($employee) ? $employee->admission: '' }}">
                                                </div>
                                                <div class="form-group col">
                                                    <label>Empresa</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col">
                                                    <label>Setor</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col">
                                                    <label>Cargo</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                    </div>
                                                </div>

                                                <div class="form-row">

                                                <div class="form-group col-md-4">
                                                    <label>Nome Completo</label>
                                                    <input class="form-control" type="text" name="name" placeholder="John Smith" value="{{ isset($employee) ? $employee->name: '' }}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>CPF</label>
                                                    <input class="form-control" type="string" name="document_number" placeholder="798.174.898-30" value="{{ isset($document_number) ? $employee->email: '' }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Email</label>
                                                    <input class="form-control" type="email" name="email" placeholder="employee@example.com" value="{{ isset($employee) ? $employee->email: '' }}">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Telefone</label>
                                                    <input class="form-control" type="text" name="phone" placeholder="" value="{{ isset($employee) ? $employee->phone: '' }}">
                                                </div>
                                                </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-2">
                                                    <label for="cep">CEP</label>
                                                    <input type="text" class="form-control" id="cep">
                                                  </div>
                                                  <div class="form-group col-md-2">
                                                    <label for="state">Estado</label>
                                                    <select id="state" class="form-control">
                                                      <option selected>Choose...</option>
                                                      <option>...</option>
                                                    </select>
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                    <label for="city">Cidade</label>
                                                    <input type="text" class="form-control" id="city">
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                    <label for="district">Bairro</label>
                                                    <input type="text" class="form-control" id="district">
                                                  </div>

                                              </div>


                                              <div class="form-row">
                                                <div class="form-group col">
                                                    <label for="address">Endereço</label>
                                                    <input type="text" class="form-control" id="address" placeholder="1234 Main St">
                                                  </div>


                                              </div>

                                            <div class="row">
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn btn-warning m-2" type="reset">Resetar</button>
                                                <button class="btn btn-primary m-2" type="submit">Atualizar</button>
                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>


                            </div>

                        </div>
                        </div>
                    </form>

                </div>
                </div>
                </div>
</section>

@endsection
@section('js')
<script>
$(document).ready(function() {
var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.avatar').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(".file-upload").on('change', function(){
    readURL(this);
});
});
</script>
@endsection

