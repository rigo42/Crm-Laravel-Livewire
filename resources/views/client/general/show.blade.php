@extends('layouts.main')

@section('title', $client->name)

@section('content')
    <!--begin::Bread-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <a class="text-dark" href="{{ route('client.index') }}"><h5 class="text-dark font-weight-bold my-2 mr-5">Clientes</h5></a>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item active">
                            <a href="#" class="text-muted">{{ $client->name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">

                    @if ($client->premium)
                        <div class="ribbon ribbon-top ribbon-ver">
                            <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
                                <i class="fa fa-star text-white"></i>
                            </div>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                            <!--begin::Pic-->
                            <div class="col-md-3">
                                <img class="img-fluid" alt="{{ $client->name }}" 
                                @if ($client->image)
                                    src="{{ Storage::url($client->image->url) }}" 
                                @else
                                    src="{{ asset('assets/media/users/blank.png') }}" 
                                @endif
                                />
                            </div> 
                            <!--begin: Info-->
                            <div class="col-md-9">
                                <!--begin::Title-->
                                <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                                    <!--begin::User-->
                                    <div class="mr-3">
                                        <div class="d-flex align-items-center mr-3">
                                            <!--begin::Name-->
                                            <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $client->name }}</a>
                                        </div>
                                        <!--begin::Contacts-->
                                        <div class="d-flex flex-wrap my-2">
                                            <a href="mailto:{{ $client->email }}" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                    <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Communication/Mail-notification.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                            <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>{{ $client->email }}
                                            </a>
                                            <a href="tel:{{ $client->phone }}" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M7.13888889,4 L7.13888889,19 L16.8611111,19 L16.8611111,4 L7.13888889,4 Z M7.83333333,1 L16.1666667,1 C17.5729473,1 18.25,1.98121694 18.25,3.5 L18.25,20.5 C18.25,22.0187831 17.5729473,23 16.1666667,23 L7.83333333,23 C6.42705272,23 5.75,22.0187831 5.75,20.5 L5.75,3.5 C5.75,1.98121694 6.42705272,1 7.83333333,1 Z" fill="#000000" fill-rule="nonzero"/>
                                                            <polygon fill="#000000" opacity="0.3" points="7 4 7 19 17 19 17 4"/>
                                                            <circle fill="#000000" cx="12" cy="21" r="1"/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>{{ $client->phone }}
                                            </a>
                                        </div>
                                        <!--end::Contacts-->
                                    </div>
                                    <!--begin::User-->
                                    <!--begin::Actions-->
                                    <div class="mb-4">
                                        <!--start::Toolbar-->
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('client.show', $client) }}"><i class="fas fa-file-pdf mr-2"></i> Adjuntar factura</a>
                                                    <a class="dropdown-item" href="{{ route('client.show', $client) }}"><i class="fa fa-credit-card mr-2"></i> Generar un pago</a>
                                                    <a class="dropdown-item" href="{{ route('client.show', $client) }}"><i class="fa fa-calculator mr-2"></i> Generar un gasto</a>
                                                    <a class="dropdown-item" href="{{ route('client.edit', $client) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $client->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Title-->

                                <!-- Info payments -->
                                <div class="d-flex align-items-center justify-content-start flex-wrap mb-4">
                                    <!--begin: Item-->
                                    <div class="mr-1 col-lg-2 col-auto text-dark border border-dashed rounded mb-4">
                                        <span class="mr-4">
                                            <i class="flaticon-price-tag icon-2x font-weight-bold text-dark"></i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder font-size-sm">Ingresos</span>
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="font-weight-bold">$</span>164,700</span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <!--begin: Item-->
                                    <div class="mr-1 col-lg-2 col-auto text-success border border-dashed rounded mb-4">
                                        <span class="mr-4">
                                            <i class="flaticon-piggy-bank icon-2x font-weight-bold text-success"></i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder font-size-sm ">Pagos</span>
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="font-weight-bold ">$</span>249,500</span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <!--begin: Item-->
                                    <div class="mr-1 col-lg-2 col-auto text-danger border border-dashed rounded mb-4">
                                        <span class="mr-4">
                                            <i class="flaticon-confetti icon-2x font-weight-bold text-danger"></i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder font-size-sm">Gastos</span>
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="font-weight-bold">$</span>164,700</span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                </div>
                                
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                </div>
                <!--end::Card-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-custom mb-5">
                            <!--begin::Header-->
                            <div class="card-header h-auto py-4">
                                <div class="card-title">
                                    <h3 class="card-label">Más información
                                        <span class="d-block text-muted pt-2 font-size-sm">Datos de empresa y dirección</span>
                                    </h3>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-4">
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Origen:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $client->origin }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Empresa:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $client->company }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Dirección:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext">
                                            <span class="font-weight-bolder">{{ $client->address }}</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Razón social:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $client->social_reason }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Diección fiscal:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">
                                            {{ $client->fiscal_address }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">RFC:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">
                                            {{ $client->rfc }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets') }}/media/svg/shapes/abstract-4.svg)">
                            <!--begin::Body-->
                            <div class="card-body">
                                <a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">Pertenece a</a>
                                <div class="">
                                    <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">
                                        @if ($client->user)
                                            <span class="badge badge-info">{{ $client->user->name }}</span>
                                        @else
                                            <span class="badge badge-secondary">Ninguno</span>
                                        @endif
                                    </p> 
                                    <br>
                                    <div class="font-weight-bold text-success mb-5">{{ $client->created_at->diffforhumans() }}</div>
                                </div>
                                
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header card-header-tabs-line">
                                <div class="card-toolbar">
                                    <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-bold nav-tabs-line-3x" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                        <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/General/Notification2.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
                                                                <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                <span class="nav-text">Estadisticas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-3">
                                            <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                        <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Communication/Chat-check.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                <span class="nav-text">Pagos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-3">
                                            <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                        <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Devices/Display1.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z" fill="#000000" opacity="0.3" />
                                                                <path d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z" fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                <span class="nav-text">Gastos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-3">
                                            <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                        <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Home/Globe.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero" />
                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                <span class="nav-text">Servicios</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-3">
                                            <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_5">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                        <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Home/Globe.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero" />
                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                <span class="nav-text">Facturas</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body px-0">
                                <div class="tab-content ">
                                    <!--begin::Tab Content-->
                                    <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                                        <div class="container">
                                            <div id="kt_flotcharts_1" style="height: 300px;"></div>
                                            <div class="card-body pt-5">
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center flex-wrap mb-10">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-50 symbol-light mr-5">
                                                        <span class="symbol-label">
                                                            <i class="fas fa-dollar-sign text-dark fa-2x"></i>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Ventas</a>
                                                        <span class="text-muted font-weight-bold">Total de venta</span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">82$</span>
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center flex-wrap mb-10">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-50 symbol-light mr-5">
                                                        <span class="symbol-label">
                                                            <i class="fas fa-dollar-sign text-success fa-2x"></i>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-success font-size-lg mb-1">Ingresos</a>
                                                        <span class="text-muted font-weight-bold">Total de ingresos</span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-success font-weight-bolder">+280$</span>
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center flex-wrap mb-10">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-50 symbol-light mr-5">
                                                        <span class="symbol-label">
                                                            <i class="fas fa-dollar-sign text-danger fa-2x"></i>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-danger font-size-lg mb-1">Gastos</a>
                                                        <span class="text-muted font-weight-bold">Total de gastos</span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-danger font-weight-bolder">-4500$</span>
                                                </div>
                                                <!--end::Item-->
                                                <hr class="spacer">
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center flex-wrap mb-10">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-50 symbol-light mr-5">
                                                        <span class="symbol-label">
                                                            <i class="fas fa-dollar-sign text-primary fa-2x"></i>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-primary font-size-lg mb-1">Ingresos netos</a>
                                                        <span class="text-muted font-weight-bold">Total real de ingresos</span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-primary font-weight-bolder">+4500$</span>
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Tab Content-->
                                    <!--begin::Tab Content-->
                                    <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                                        <!--begin::Body-->
                                        <div class="card-body pt-0 pb-3">
                                            <div class="my-3">
                                                <span class="text-muted font-weight-bold font-size-sm">(15) pago(s)</span>
                                            </div>
                                            <!--begin::Table-->
                                            <div class="table-responsive">
                                                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                                    <thead>
                                                        <tr class="text-uppercase">
                                                            <th>Monto</th>
                                                            <th>Fecha de pago</th>
                                                            <th>Servicio</th>
                                                            <th>Nota personal</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$800</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">31 de julio 2021</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg ">Página web</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Esta es una nota personal</span>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left"  style="position: initial!important;">
                                                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="ki ki-bold-more-hor"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="position: inherit;">
                                                                            <!--begin::Navigation-->
                                                                            <ul class="navi navi-hover py-5">
                                                                                <li class="navi-item">
                                                                                    <a href="#" class="navi-link">
                                                                                        <span class="navi-icon">
                                                                                            <i class="fa fa-pen"></i>
                                                                                        </span>
                                                                                        <span class="navi-text">Editar</span>
                                                                                    </a>
                                                                                </li>
                                                                                <li class="navi-item">
                                                                                    <a href="#" class="navi-link">
                                                                                        <span class="navi-icon">
                                                                                            <i class="fa fa-eye"></i>
                                                                                        </span>
                                                                                        <span class="navi-text">Ver</span>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                            <!--end::Navigation-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::Tab Content-->
                                    <!--begin::Tab Content-->
                                    <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                                        <!--begin::Body-->
                                        <div class="card-body pt-0 pb-3">
                                            <div class="my-3">
                                                <span class="text-muted font-weight-bold font-size-sm">(15) gasto(s)</span>
                                            </div>
                                            <!--begin::Table-->
                                            <div class="table-responsive">
                                                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                                    <thead>
                                                        <tr class="text-uppercase">
                                                            <th>Monto</th>
                                                            <th>Fecha de gasto</th>
                                                            <th>Categoría</th>
                                                            <th>Nota personal</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$800</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">31 de julio 2021</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg ">Página web</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Esta es una nota personal</span>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left"  style="position: initial!important;">
                                                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="ki ki-bold-more-hor"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="position: inherit;">
                                                                            <!--begin::Navigation-->
                                                                            <ul class="navi navi-hover py-5">
                                                                                <li class="navi-item">
                                                                                    <a href="#" class="navi-link">
                                                                                        <span class="navi-icon">
                                                                                            <i class="fa fa-pen"></i>
                                                                                        </span>
                                                                                        <span class="navi-text">Editar</span>
                                                                                    </a>
                                                                                </li>
                                                                                <li class="navi-item">
                                                                                    <a href="#" class="navi-link">
                                                                                        <span class="navi-icon">
                                                                                            <i class="fa fa-eye"></i>
                                                                                        </span>
                                                                                        <span class="navi-text">Ver</span>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                            <!--end::Navigation-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::Tab Content-->
                                    <!--begin::Tab Content-->
                                    <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                                        <!--begin::Body-->
                                        <div class="card-body pt-0 pb-3">
                                            <div class="my-3">
                                                <span class="text-muted font-weight-bold font-size-sm">(15) gasto(s)</span>
                                            </div>
                                            <!--begin::Table-->
                                            <div class="table-responsive">
                                                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                                    <thead>
                                                        <tr class="text-uppercase">
                                                            <th>Nombre</th>
                                                            <th>Fecha de inicio</th>
                                                            <th>Nota personal</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$800</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">31 de julio 2021</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg ">Página web</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Esta es una nota personal</span>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left"  style="position: initial!important;">
                                                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="ki ki-bold-more-hor"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="position: inherit;">
                                                                            <!--begin::Navigation-->
                                                                            <ul class="navi navi-hover py-5">
                                                                                <li class="navi-item">
                                                                                    <a href="#" class="navi-link">
                                                                                        <span class="navi-icon">
                                                                                            <i class="fa fa-pen"></i>
                                                                                        </span>
                                                                                        <span class="navi-text">Editar</span>
                                                                                    </a>
                                                                                </li>
                                                                                <li class="navi-item">
                                                                                    <a href="#" class="navi-link">
                                                                                        <span class="navi-icon">
                                                                                            <i class="fa fa-eye"></i>
                                                                                        </span>
                                                                                        <span class="navi-text">Ver</span>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                            <!--end::Navigation-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::Tab Content-->
                                    <!--begin::Tab Content-->
                                    <div class="tab-pane" id="kt_apps_contacts_view_tab_5" role="tabpanel">
                                        <div class="container">
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <!--begin::Card-->
                                                    <div class="card card-custom gutter-b card-stretch">
                                                        <div class="card-header border-0">
                                                            <h3 class="card-title"></h3>
                                                            <div class="card-toolbar">
                                                                <!--start::Toolbar-->
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="ki ki-bold-more-hor"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                            <a class="dropdown-item" href="{{ route('client.show', $client) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                                                            <a class="dropdown-item" href="{{ route('client.edit', $client) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $client->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <!--begin: Icon-->
                                                                <img alt="" class="max-h-65px" src="{{ asset('assets') }}/media/svg/files/pdf.svg">
                                                                <!--end: Icon-->
                                                                <!--begin: Tite-->
                                                                <a href="#" class="text-dark-75 font-weight-bold mt-15 font-size-lg">Technical Requiremnts.pdf</a>
                                                                <!--end: Tite-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end:: Card-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <!--begin::Card-->
                                                    <div class="card card-custom gutter-b card-stretch">
                                                        <div class="card-header border-0">
                                                            <h3 class="card-title"></h3>
                                                            <div class="card-toolbar">
                                                                <!--start::Toolbar-->
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="ki ki-bold-more-hor"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                            <a class="dropdown-item" href="{{ route('client.show', $client) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                                                            <a class="dropdown-item" href="{{ route('client.edit', $client) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $client->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <!--begin: Icon-->
                                                                <img alt="" class="max-h-65px" src="{{ asset('assets') }}/media/svg/files/doc.svg">
                                                                <!--end: Icon-->
                                                                <!--begin: Tite-->
                                                                <a href="#" class="text-dark-75 font-weight-bold mt-15 font-size-lg">Project Budget.docx</a>
                                                                <!--end: Tite-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end:: Card-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <!--begin::Card-->
                                                    <div class="card card-custom gutter-b card-stretch">
                                                        <div class="card-header border-0">
                                                            <h3 class="card-title"></h3>
                                                            <div class="card-toolbar">
                                                                <!--start::Toolbar-->
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="ki ki-bold-more-hor"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                            <a class="dropdown-item" href="{{ route('client.show', $client) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                                                            <a class="dropdown-item" href="{{ route('client.edit', $client) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $client->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <!--begin: Icon-->
                                                                <img alt="" class="max-h-65px" src="{{ asset('assets') }}/media/svg/files/xml.svg">
                                                                <!--end: Icon-->
                                                                <!--begin: Tite-->
                                                                <a href="#" class="text-dark-75 font-weight-bold mt-15 font-size-lg">Navitare Booking API.xml</a>
                                                                <!--end: Tite-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end:: Card-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <!--begin::Card-->
                                                    <div class="card card-custom gutter-b card-stretch">
                                                        <div class="card-header border-0">
                                                            <h3 class="card-title"></h3>
                                                            <div class="card-toolbar">
                                                                <!--start::Toolbar-->
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="ki ki-bold-more-hor"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                            <a class="dropdown-item" href="{{ route('client.show', $client) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                                                            <a class="dropdown-item" href="{{ route('client.edit', $client) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $client->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <!--begin: Icon-->
                                                                <img alt="" class="max-h-65px" src="{{ asset('assets') }}/media/svg/files/html.svg">
                                                                <!--end: Icon-->
                                                                <!--begin: Tite-->
                                                                <a href="#" class="text-dark-75 font-weight-bold mt-15 font-size-lg">User List.html</a>
                                                                <!--end: Tite-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end:: Card-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Tab Content-->
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
    </div>
@endsection

@section('footer')
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets') }}/plugins/custom/flot/flot.bundle.js"></script>
    <script src="{{ asset('assets') }}/js/pages/features/charts/flotcharts.js"></script>
@endsection