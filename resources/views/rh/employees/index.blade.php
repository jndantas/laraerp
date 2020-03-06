@extends('layouts.master')

@section('title')
Funcionários
@stop

@section('content')


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Funcionários</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
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
    <div class="card card-solid">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-2x fa-user-tie"></i>
                <a href="{{ route('employees.create') }}" class="btn btn-primary btn-circle float-right"><i class="fas fa-plus"></i></a>
        </div>
        <div class="card-body pb-0">
            @foreach($employees->chunk(3) as $chunk)

            <div class="row d-flex align-items-stretch">
                @foreach($chunk as $employee)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                      <div class="card-header text-muted border-bottom-0">

                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                          <div class="col-7">
                            <h2 class="lead m-2"><b>#{{ $employee->id }} | {{ $employee->name }}</b></h2>
                            <p class="text-muted text-sm"><b>Empresa: </b>{{ $employee->enterprise->name }} </p>
                            <p class="text-muted text-sm"><b>Setor: </b>{{ $employee->sector->name }} </p>
                            <p class="text-muted text-sm"><b>Cargo: </b>{{ $employee->position->name }} </p>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Endereço: {{ $employee->address }}</li>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefone #: {{ $employee->phone }}</li>
                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email #: {{ $employee->email }}</li>
                            </ul>
                          </div>
                          <div class="col-5 text-center">
                            <img src="{{ asset($employee->photo ? $employee->photo : 'img/garoto.png') }} " class="img-circle img-fluid"/>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                            <button class="btn btn-sm btn-info">
                                <i class="fas fa-pen"></i> Editar
                            </button>

                            <button onclick="handleDelete({{ $employee->id }})" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Deletar
                            </button>

                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
            </div>
            @endforeach

        </div>
    </div>
</section>



<form action="" method="POST" id="deleteForm">
@csrf
@method('DELETE')
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="deleteModalLabel">Apagar Usuário</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p class="text-center text-bold">
          Você realmente quer apagar esse Usuário?
      </p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Não, Volte!</button>
      <button type="submit" class="btn btn-danger">Sim, Apague!</button>
    </div>
  </div>
</div>
</div>
</form>

@endsection

@section('js')

<script>
function handleDelete(id){
var form = document.getElementById('deleteForm')
form.action = '/admin/user/' + id
$('#deleteModal').modal('show')
}
</script>

@endsection
