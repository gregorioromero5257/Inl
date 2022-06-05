@extends('layouts.app')

@section('content')
<div class="row no-gutters justify-content-md-center align-items-center mb-4">
    <div class="col-4">
        <img src="/img/assets/logo_herramienta_login.svg" class="card-img mt-2 text-center" alt="logo">
    </div>
    <!-- <div class="col-12 col-md-5">
        <div class="card-body">
            <span class="h4 font-weight-bolder">Herramienta de Mapeo de Decisiones de</span><br>
            <span class="h2 font-weight-bolder">Agentes del Ministerio Público</span>
        </div>
    </div> -->
</div>
<div class="row justify-content-center mt-4 ml-3 mr-3">
    <div class="col-md-6">
        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <div class="form-group">
                <label for="email">{{ __('Correo electrónico') }}</label>
                <input id="email" type="email" class="form-control-color form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group mb-4">
                <label for="password">{{ __('Contraseña') }}</label>
                <input id="password" type="password" class="form-control-color form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-round w80 hbig">
                    {{ __('Iniciar sesión') }}
                </button>
                <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a> -->
            </div>
        </form>
    </div>
</div>
@endsection
