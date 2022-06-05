@extends('layouts.app')

@section('content')
<div class="bg-login h-100 d-flex justify-content-center align-items-center">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center mb-3">
                <h1 class="display-5 font-weight-light">
                    <img class="logo-login" src="/img/01_login--0.png" >
                </h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-5">
              <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                  @csrf
                  <div class="form-group">
                      <label for="email">{{ __('Correo electrónico') }}</label>
                      <br>
                      <label for="email" style="color: #6c757d;">Email</label>
                      <input id="email" type="email" class="form-control-color form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                      @if ($errors->has('email'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group mb-4">
                      <label for="password">{{ __('Contraseña') }}</label>
                      <br>
                      <label for="email" style="color: #6c757d;">Password</label>
                      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-color" name="password" required>
                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group mb-8">
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked style="transform: scale(1.5);">
                          <label class="form-check-label" for="exampleRadios1">
                            Español
                          </label>
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" style=" transform: scale(1.5); margin-left: 8px;
                          ">
                          <label class="form-check-label" for="exampleRadios2" style="margin-left: 28px;">
                            Inglés
                          </label>
                        </div>
                  </div>

                  <div class="text-center">
                      <button type="submit" class="btn btn-primary btn-round w80 hbig" style="height:56px"  onclick="validateLanguaje()">
                          {{ __('Iniciar sesión') }}
                          <br>
                          Login
                      </button>
                      <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                          {{ __('¿Olvidaste tu contraseña?') }}
                      </a> -->
                      <br>
                      <!-- <label for="email" style="color: #6c757d;">Forgot your password?</label> -->
                      </div>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>

<!--
<div class="row no-gutters justify-content-md-center align-items-center mb-4">
    <div class="col-4 ">
        <img src="/img/01_login0.png" class="card-img mt-2" alt="logo">
    </div> -->
    <!-- <div class="col-12 col-md-5">
        <div class="card-body">
            <span class="h4 font-weight-bolder">Herramienta de Mapeo de Decisiones de</span><br>
            <span class="h2 font-weight-bolder">Agentes del Ministerio Público</span>
        </div>
    </div> -->
<!-- </div> -->
<!-- <div class="row no-gutters justify-content-md-center  mb-4">
    <div class="col-md-6">
        <h3 class="font-weight-bold ml-4">Iniciar sesión</h3>
        <h4 class="font-weight-bold ml-4" style="color: #6c757d;">Login</h4>
    </div>
</div>
<div class="row justify-content-center ml-3 mr-3">
    <div class="col-md-6">

    </div>
</div> -->
<script>
    function validateLanguaje(){
        if ($('#exampleRadios1').is(':checked')) {
            const item = localStorage.getItem("languaje");
            if (!item) {
                localStorage.setItem("languaje", "es");
            }
            else{
                localStorage.removeItem("titulo");
                localStorage.setItem("languaje", "es");
            }
        }
        if ($('#exampleRadios2').is(':checked')) {
            const item = localStorage.getItem("languaje");
            if (!item) {
                localStorage.setItem("languaje", "en");
            }
            else{
                localStorage.removeItem("titulo");
                localStorage.setItem("languaje", "en");
            }
        }
    }

</script>
@endsection
