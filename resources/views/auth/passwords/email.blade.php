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
        <h3 class="font-weight-bold text-center">{{ __('Restablecer la contraseña') }}</h3>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
            @csrf
            <div class="form-group">
                <label for="email">{{ __('E-Mail Address') }}</label>

                <input id="email" type="email" class="form-control-color form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-round w80 hbig">
                    {{ __('Enviar enlace de restablecimiento de contraseña') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
