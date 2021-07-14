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
                            <a href="#" class="text-muted">@yield('title')</a>
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
                                                    @can('cotizaciones')
                                                        <a class="dropdown-item" href="{{ route('quotation.create', ['client' => $client]) }}"><i class="fa fa-sticky-note mr-2"></i> Adjuntar cotización</a>
                                                    @endcan
                                                    @can('facturas')
                                                        <a class="dropdown-item" href="{{ route('invoice.create', ['client' => $client]) }}"><i class="fas fa-file-pdf mr-2"></i> Adjuntar factura</a>
                                                    @endcan
                                                    @can('pagos')
                                                        <a class="dropdown-item" href="{{ route('payment.create', ['client' => $client->id]) }}"><i class="fa fa-credit-card mr-2"></i> Generar un pago</a>
                                                    @endcan
                                                    @can('gastos')
                                                        <a class="dropdown-item" href="{{ route('expense.create', ['client' => $client->id]) }}"><i class="fa fa-calculator mr-2"></i> Generar un gasto</a>
                                                    @endcan
                                                    <a class="dropdown-item" href="{{ route('client.edit', $client) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Title-->

                                <!-- Info payment -->
                                <div class="d-flex align-items-center justify-content-start flex-wrap mb-4">
                                    <!--begin: Item-->
                                    <div class="mr-1 col-lg-3 col-auto text-dark border border-dashed rounded mb-4">
                                        <span class="mr-4">
                                            <i class="flaticon-price-tag icon-2x font-weight-bold text-dark"></i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder font-size-sm">Ingresos por facturas</span>
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="font-weight-bold">{{ $client->incomeByInvoiceTotal() }}</span>
                                        </div>
                                    </div>
                                    <!--begin: Item-->
                                    <div class="mr-1 col-lg-3 col-auto text-danger border border-dashed rounded mb-4">
                                        <span class="mr-4">
                                            <i class="flaticon-price-tag icon-2x font-weight-bold text-danger"></i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder font-size-sm">Pendientes por facturas</span>
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="font-weight-bold">{{ $client->pendingByInvoiceTotal() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info payment -->
                                <div class="d-flex align-items-center justify-content-start flex-wrap mb-4">
                                    <!--begin: Item-->
                                    <div class="mr-1 col-lg-3 col-auto text-dark border border-dashed rounded mb-4">
                                        <span class="mr-4">
                                            <i class="flaticon-price-tag icon-2x font-weight-bold text-dark"></i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="font-weight-bolder font-size-sm">Ingreso bruto</span>
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="font-weight-bold">{{ $client->grossIncomeTotal() }}</span>
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
                                            <span class="font-weight-bold ">{{ $client->paymentTotal() }}</span>
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
                                            <span class="font-weight-bold">{{ $client->expenseTotal() }}</span>
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
                                    <label class="col-4 col-form-label">Categoría:</label>
                                    <div class="col-8">
                                        @if ($client->categoryClient)
                                            <span class="badge badge-primary font-weight-bold">{{ $client->categoryClient->name }}</span>
                                        @else
                                            <span class="badge badge-secondary font-weight-bold">Ninguno</span>
                                        @endif
                                    </div>
                                </div>
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
                            <div class="card-body">
                                @if ($client->user)
                                    <a href="{{ route('user.show', $client->user) }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">Pertenece a</a>
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
                                @else
                                    <span class="badge badge-secondary">Este cliente no tiene asignado ningun usuario</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header card-header-tabs-line">
                                <div class="card-toolbar">
                                    <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-bold nav-tabs-line-3x" role="tablist">
                                       
                                        <li class="nav-item mr-3">
                                            <a class="nav-link active" data-toggle="tab" href="#payment">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                        <i class="fa fa-credit-card"></i>
                                                    </span>
                                                </span>
                                                <span class="nav-text">Pagos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-3">
                                            <a class="nav-link" data-toggle="tab" href="#expense">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                       <i class="fa fa-calculator"></i>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                <span class="nav-text">Gastos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-3">
                                            <a class="nav-link" data-toggle="tab" href="#service">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                       <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                                <span class="nav-text">Servicios</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-3">
                                            <a class="nav-link" data-toggle="tab" href="#project">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                       <i class="fas fa-rocket"></i>
                                                    </span>
                                                </span>
                                                <span class="nav-text">Proyectos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-3">
                                            <a class="nav-link" data-toggle="tab" href="#invoice">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </span>
                                                </span>
                                                <span class="nav-text">Facturas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-3">
                                            <a class="nav-link" data-toggle="tab" href="#quotation">
                                                <span class="nav-icon mr-2">
                                                    <span class="svg-icon mr-3">
                                                        <i class="fa fa-sticky-note"></i>
                                                    </span>
                                                </span>
                                                <span class="nav-text">Cotizaciones</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body px-0">
                                <div class="tab-content ">

                                    <div class="tab-pane active" id="payment" role="tabpanel">
                                        @livewire('payment.index', ['client' => $client])
                                    </div>
                                    
                                    <div class="tab-pane" id="expense" role="tabpanel">
                                        @livewire('expense.index', ['client' => $client])
                                    </div>
                                    
                                    <div class="tab-pane" id="service" role="tabpanel">
                                        @livewire('service.index', ['client' => $client, 'type' => 'Mensual'], key('service'))
                                    </div>

                                    <div class="tab-pane" id="project" role="tabpanel">
                                        @livewire('service.index', ['client' => $client, 'type' => 'Proyecto'], key('project'))
                                    </div>
                                    
                                    <div class="tab-pane" id="invoice" role="tabpanel">
                                        @livewire('invoice.index', ['client' => $client], key($client->id))
                                    </div>
                                    
                                    <div class="tab-pane" id="quotation" role="tabpanel">
                                        @livewire('quotation.index', ['client' => $client], key($client->id))
                                    </div>
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
