@extends('layouts.main')

@section('title', 'Ajustes')

@section('content')
    <!--begin::Bread-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <a href="#"><h5 class="text-dark font-weight-bold my-2 mr-5">@yield('title')</h5></a>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                
                <div class="row">

                    @include('setting.menu.index')

                    <div class="col-xl-9">
                        <!--begin::Engage Widget 9-->
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-body d-flex p-0">
                                <div class="flex-grow-1 p-20 pb-40 card-rounded flex-grow-1 bgi-no-repeat" style="background-color: #1B283F; background-position: calc(100% + 0.5rem) bottom; background-size: 50% auto; background-image: url({{ asset('assets') }}/media/svg/humans/custom-10.svg)">
                                    <h2 class="text-white pb-5 font-weight-bolder">Bienvenido a configuración</h2>
                                    <p class="text-muted pb-5 font-size-h5">En este lugar podrás realizar ajustes a tu cuenta. <br>
                                        Crear roles y permisos, y lo más importante <br> crea copias de seguridad de la información del sistema. <br>
                                        Configura los metodos disponibles de pago, <br>
                                        crea categorías de gastos, todo lo que necesites :)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection