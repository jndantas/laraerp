@extends('layouts.auth')

@section('title')
Login
@stop

@section('content')

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Entre para iniciar sua sessão!</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-mail') }}" required autocomplete="email" autofocus>
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
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Senha') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
                        <label for="remember">
                                    {{ __('Lembrar') }}
                                </label>
                    </div>
                </div>

                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        @if (Route::has('password.request'))
        <p class="mb-1">
            <a href="{{ route('password.request') }}">{{ __('Esqueceu sua senha?') }}</a>
        </p>
        @endif
        <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">{{ __('Registrar um novo membro') }}</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>

@endsection
