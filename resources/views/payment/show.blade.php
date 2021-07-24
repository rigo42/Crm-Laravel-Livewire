@extends('layouts.main')

@section('title', $payment->concept)

@section('content')
    <!--begin::Bread-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <a class="text-dark" href="{{ route('payment.index') }}"><h5 class="text-dark font-weight-bold my-2 mr-5">Pagos</h5></a>
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
               
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-custom mb-5 ">
                            
                            <!--begin::Header-->
                            <div class="card-header h-auto py-4">
                                
                            
                                <div class="card-title">
                                    <h3 class="card-label">{{ $payment->concept }}
                                        <span class="d-block text-muted pt-2 font-size-sm">Datos del Pago</span>
                                    </h3>
                                </div>

                                <!--start::Toolbar-->
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left" style="position: initial!important;">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" >
                                            @if ($payment->invoice)
                                                <a class="dropdown-item" target="_blank" href="{{ Storage::url($payment->invoice->url) }}"><i class="fas fa-download mr-2"></i> Descargar factura</a>
                                            @endif
                                            @if ($payment->image)
                                                <a class="dropdown-item" target="_blank" href="{{ Storage::url($payment->image->url) }}"><i class="fas fa-download mr-2"></i> Descargar comprobante de pago</a>
                                            @endif
                                            @livewire('payment.send-email', ['payment' => $payment], key($payment->id))
                                            <a class="dropdown-item" href="{{ route('payment.edit', $payment) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-4">
                                <div class="text-center mb-10">
                                    <div class="symbol symbol-60 symbol-circle symbol-xl-90">
                                        <div class="symbol-label" 
                                            @if ($payment->client->image)
                                                style="background-image:url({{ Storage::url($payment->client->image->url) }}" 
                                            @else
                                                style="background-image:url({{ asset('assets/media/users/blank.png') }}" 
                                            @endif
                                            ></div>
                                    </div>
                                    <div class="text-muted mb-2">{{ $payment->client->name }} {{ $payment->client->company ? '('.$payment->client->company.')' : '' }}</div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Tipo de pago:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">
                                            {{ $payment->paymentType->name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Comprobante:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">
                                            @if ($payment->proof)
                                                {{ $payment->proof }}
                                            @else
                                                <span class="badge badge-pill badge-light">Ninguno</span>
                                            @endif
                                            
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Fecha de registro:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $payment->dateToString() }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Fecha de corte:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $payment->cutoffDateToString() }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Cuenta:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $payment->account->name }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">monto:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $payment->montoToString() }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Concepto:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $payment->concept }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Nota:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $payment->note }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">¿Correo enviado?</label>
                                    <div class="col-8 d-flex align-items-center">
                                        @if ($payment->send_email)
                                            <span class="badge badge-success">Correo enviado</span>
                                        @else
                                            <span class="badge badge-pill badge-light">No enviado</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Pago registrado por:</label>
                                    <div class="col-8 d-flex align-items-center">
                                        <span class="form-control-plaintext font-weight-bolder">
                                            @if ($payment->user)
                                                {{ $payment->user->name }}
                                            @else
                                                <span class="badge badge-secondary">Usuario eliminado</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-xl-8">
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto py-4">
                                <div class="card-title">
                                    <h3 class="card-label">Servicio asociado a este pago</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group m-0">
                                    <div class="row">
                                        @if ($payment->service)
                                            <div class="col-lg-6">
                                                @can('servicios')
                                                <a href="{{ route('service.show', $payment->service) }}" >
                                                @endcan
                                                    <label class="option" style="cursor: pointer;">
                                                        <span class="option-label">
                                                            <span class="option-head">
                                                                <span class="option-title">{{ $payment->service->serviceType->name }}</span>
                                                                <span class="option-focus">{{ $payment->service->priceToString() }}</span>
                                                            </span>
                                                            <span class="option-body">{{ $payment->service->note }}</span>
                                                        </span>
                                                    </label>
                                                @can('servicios')
                                                </a>
                                                @endcan
                                            </div>
                                        @else
                                            <span class="badge badge-secondary">No se encontró ningun servicio ligado a este pago</span>
                                        @endif
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                        @if ($payment->proof == 'Factura')
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header h-auto py-4">
                                    <div class="card-title">
                                        <h3 class="card-label">Factura asociada</h3>
                                    </div>
                                    <!--start::Toolbar-->
                                    @if ($payment->invoice)
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left" style="position: initial!important;">
                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" >
                                                    <a class="dropdown-item" target="_blank" href="{{ Storage::url($payment->invoice->url) }}"><i class="fas fa-download mr-2"></i> Descargar factura</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    @if ($payment->invoice)
                                        <embed width="100%" height="600px" src="{{ Storage::url($payment->invoice->url) }}" type="">
                                    @else
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-lg btn-warning" href="{{ route('payment.edit', $payment) }}#proof">Falta adjuntar factura</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        @elseif ($payment->proof == 'Voucher')
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header h-auto py-4">
                                    <div class="card-title">
                                        <h3 class="card-label">Voucher</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if ($payment->image)
                                        <img class="img-fluid" src="{{ Storage::url($payment->image->url) }}" />
                                    @else
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-lg btn-warning" href="{{ route('payment.edit', $payment) }}#proof">Falta adjuntar voucher</a>
                                        </div>
                                    @endif
                                
                                </div>
                            </div>
                        @else
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header h-auto py-4">
                                    <div class="card-title">
                                        <h3 class="card-label">Comprobante</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <span class="d-block badge badge-secondary text-muted pt-2 font-size-sm">Ninguno</span>
                                </div>
                            </div>
                        @endif

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