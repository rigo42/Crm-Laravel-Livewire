@extends('layouts.main')

@section('title', $quotation->concept)

@section('content')
    <!--begin::Bread-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <a class="text-dark" href="{{ route('quotation.index') }}"><h5 class="text-dark font-weight-bold my-2 mr-5">Cotizaciones</h5></a>
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
                                    <h3 class="card-label"><a href="{{ route('client.show', $quotation->client) }}">{{ $quotation->client->name }}</a>
                                        <span class="d-block text-muted pt-2 font-size-sm">Datos del cliente</span>
                                    </h3>
                                </div>
                                <!--start::Toolbar-->
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('client.show', $quotation->client) }}"><i class="fa fa-eye mr-2"></i> Ver cliente</a>
                                            <a class="dropdown-item" href="{{ route('quotation.edit', $quotation) }}"><i class="fa fa-pen mr-2"></i> Editar factura</a>
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
                                            @if ($quotation->client->image)
                                                style="background-image:url({{ Storage::url($quotation->client->image->url) }}" 
                                            @else
                                                style="background-image:url({{ asset('assets/media/users/blank.png') }}" 
                                            @endif
                                            ></div>
                                    </div>
                                    <div class="text-muted mb-2">{{ $quotation->client->company }}</div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Origen:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $quotation->client->origin }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Empresa:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $quotation->client->company }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Dirección:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext">
                                            <span class="font-weight-bolder">{{ $quotation->client->address }}</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Razón social:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $quotation->client->social_reason }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Diección fiscal:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">
                                            {{ $quotation->client->fiscal_address }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">RFC:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">
                                            {{ $quotation->client->rfc }}
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets') }}/media/svg/shapes/abstract-4.svg)">
                            <!--begin::Body-->
                            <div class="card-body">
                                <a href="{{ route('user.show', $quotation->client->user) }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">Cliente pertenece al usuario</a>
                                <div class="">
                                    <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">
                                        @if ($quotation->client->user)
                                            <span class="badge badge-info">{{ $quotation->client->user->name }}</span>
                                        @else
                                            <span class="badge badge-secondary">Ninguno</span>
                                        @endif
                                    </p> 
                                    <br>
                                    <div class="font-weight-bold text-success mb-5">{{ $quotation->client->created_at->diffforhumans() }}</div>
                                </div>
                                
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto py-4">
                                <div class="card-title">
                                    <h3 class="card-label">{{ $quotation->concept }}</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($quotation->url)
                                    <embed width="100%" height="600px" src="{{ Storage::url($quotation->url) }}" type="">
                                @else
                                    <span class="d-block badge badge-secondary text-muted pt-2 font-size-sm">Ninguno</span>
                                @endif
                               
                            </div>
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