@extends('layouts.app')

@section('title', 'Registro')

@section('content')

<!--begin::Login-->
<div class="login login-signin-on login-3 d-flex flex-row-fluid" id="kt_login">
    <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{asset('assets')}}/media/bg/bg-3.jpg);">
        <div class="login-form text-center p-7 position-relative overflow-hidden">
            <!--begin::Login Header-->
            <div class="d-flex flex-center mb-15">
                <a href="#">
                    <img src="{{ config('app.logo') }}" class="max-h-75px" alt="" />
                </a>
            </div>
            <!--end::Login Header-->
            <!--begin::Login Sign in form-->
            <div class="login-signin">
                <div class="mb-20">
                    <h3>Registro</h3>
                    <div class="text-muted font-weight-bold">Ingresa la información requerida</div>
                </div>
                @if (Route::has('register'))
                <form class="form" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group mb-5">
                        <input type="text" placeholder="Nombre" class="form-control h-auto form-control-solid py-4 px-8 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <input type="email" placeholder="Correo electronico" class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <input type="password" placeholder="Contraseña" class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <input type="password" placeholder="Confirmar contraseña" id="password-confirm" class="form-control h-auto form-control-solid py-4 px-8" name="password_confirmation" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>       

                    <div class="form-group mb-5 text-left">
                        <label class="checkbox m-0">
                        <input type="checkbox" name="agree" /> Acepto los  
                        <a href="#" class="font-weight-bold ml-1"> terminos y condiciones </a>.
                        <span></span></label>
                        <div class="form-text text-muted text-center"></div>
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center mt-10">
                        <a href="{{ route('login') }}" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Registrarme</button>
                    </div>
                </form>
                @endif
            </div>
          
        </div>
    </div>
</div>
<!--end::Login-->
@endsection
