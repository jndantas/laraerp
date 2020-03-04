@extends('layouts.auth')

@section('title')
Esqueceu a senha
@stop

@section('content')

<div class="card">
    <div class="card-body login-card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <p class="login-box-msg">Você esqueceu sua senha? Aqui você pode facilmente criar uma nova senha.</p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Enviar Link para resetar senha') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mb-1 mt-2">
            <a href="{{ route('login') }}">{{ __('Login') }}</a>
        </p>
        <p class="mb-0">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-center">{{ __('Registrar um novo membro') }}</a>
            @endif
        </p>
    </div>
    <!-- /.login-card-body -->
</div>

@endsection
