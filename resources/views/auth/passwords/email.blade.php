@extends('layouts.app')

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
            @if (Route::has('password.request'))
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-20">
                        <h3>¿Contraseña olvidada?</h3>
                        <div class="text-muted font-weight-bold">Ingresa tu correo para resetear tu contraseña</div>
                    </div>
                    <form class="form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="input-group mb-10">
                            <input 
                                class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror" 
                                type="text" 
                                placeholder="Correo" 
                                name="email"
                                autocomplete="off"
                                required
                                autofocus />
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group d-flex flex-wrap flex-center mt-10">
                            <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Enviar correo</button>
                            <a href="{{ route('login') }}" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancelar</a>
                        </div>
                    </form>                
                </div>
            @endif
        </div>
    </div>
</div>
<!--end::Login-->

@endsection
