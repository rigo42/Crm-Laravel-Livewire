@extends('layouts.app')

@section('title', 'login')

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
                    <h3>Iniciar sesión</h3>
                    <div class="text-muted font-weight-bold">Ingresa tu correo y contraseña</div>
                </div>
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group mb-5">
                        <input 
                            value="{{ old('email') }}"
                            class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror" 
                            type="text" 
                            placeholder="Correo" 
                            name="email" 
                            autocomplete="off"
                            required />
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group mb-5">
                        <input 
                            class="form-control h-auto form-control-solid py-4 px-8" 
                            type="password" 
                            placeholder="Contraseña" 
                            name="password" 
                            required/>
                            @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                        <label class="checkbox text-muted mr-4">
                        Recuerdame
                        <input 
                            name="remember" 
                            type="checkbox" 
                            {{ old('remember') ? 'checked' : '' }} 
                            type="checkbox" 
                            name="remember" />
                            <span></span>
                        </label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-muted text-hover-primary">¿Contraseña olvidada?</a>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Iniciar sesión</button>
                </form>
                @if (Route::has('register'))
                <div class="mt-10">
                    <span class="opacity-70 mr-4">¿No tienes una cuenta?</span>
                    <a href="{{ route('register') }}" class="text-muted text-hover-primary font-weight-bold">Registrate</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--end::Login-->
@endsection
