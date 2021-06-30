@extends('layouts.main')

@section('title', $payment->name)

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
                                    <div class="col-8">
                                        @if ($payment->send_email)
                                            <span class="badge badge-success">Correo enviado</span>
                                        @else
                                            <span class="badge badge-secondary">No enviado</span>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets') }}/media/svg/shapes/abstract-4.svg)">
                            <!--begin::Body-->
                            <div class="card-body">
                                @if ($payment->user)
                                    <a href="{{ route('user.show', $payment->user) }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">Pago realizado por</a>
                                    <div class="">
                                        <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">
                                            @if ($payment->user)
                                                <span class="badge badge-info">{{ $payment->user->name }}</span>
                                            @else
                                                <span class="badge badge-secondary">Ninguno</span>
                                            @endif
                                        </p> 
                                        <br>
                                        <div class="font-weight-bold text-success mb-5">{{ $payment->created_at->diffforhumans() }} ({{ $payment->createdAtToString() }})</div>
                                    </div>
                                @else
                                    <span class="badge badge-secondary">El usuario que realizó el pago fue eliminado</span>
                                @endif
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto py-4">
                                <div class="card-title">
                                    <h3 class="card-label">Servicios asociados a este pago</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group m-0">
                                    <div class="row">
                                        @forelse ($payment->services as $service)
                                        <div class="col-lg-6">
                                            <label class="option">
                                                <span class="option-label">
                                                    <span class="option-head">
                                                        <span class="option-title">{{ $service->name }}</span>
                                                        <span class="option-focus">{{ $service->priceToString() }}</span>
                                                    </span>
                                                    <span class="option-body">{{ $service->note }}</span>
                                                </span>
                                            </label>
                                        </div>
                                        @empty
                                            <span class="badge badge-secondary">No se encontró ningun servicio ligado a este pago</span>
                                        @endforelse
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto py-4">
                                <div class="card-title">
                                    <h3 class="card-label">Factura asociada</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($payment->invoice)
                                    <embed width="100%" height="600px" src="{{ Storage::url($payment->invoice->url) }}" type="">
                                @else
                                    <span class="d-block badge badge-secondary text-muted pt-2 font-size-sm">Ninguna</span>
                                @endif
                               
                            </div>
                        </div>
                         <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto py-4">
                                <div class="card-title">
                                    <h3 class="card-label">Comprobante de pago</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($payment->image)
                                    <img class="img-fluid" src="{{ Storage::url($payment->image->url) }}" />
                                @else
                                    <span class="d-block badge badge-secondary text-muted pt-2 font-size-sm">Ninguno</span>
                                @endif
                               
                            </div>
                        </div>
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