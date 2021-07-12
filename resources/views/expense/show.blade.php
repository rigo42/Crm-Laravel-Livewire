@extends('layouts.main')

@section('title', $expense->name)

@section('content')
    <!--begin::Bread-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <a class="text-dark" href="{{ route('expense.index') }}"><h5 class="text-dark font-weight-bold my-2 mr-5">gastos</h5></a>
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
                                    <h3 class="card-label">{{ $expense->concept }}
                                        <span class="d-block text-muted pt-2 font-size-sm">Datos del gasto</span>
                                    </h3>
                                </div>

                                <!--start::Toolbar-->
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left" style="position: initial!important;">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" >
                                            @if ($expense->invoice)
                                                <a class="dropdown-item" target="_blank" href="{{ Storage::url($expense->invoice->url) }}"><i class="fas fa-download mr-2"></i> Descargar factura</a>
                                            @endif
                                            @if ($expense->image)
                                                <a class="dropdown-item" target="_blank" href="{{ Storage::url($expense->image->url) }}"><i class="fas fa-download mr-2"></i> Descargar comprobante de gasto</a>
                                            @endif
                                            <a class="dropdown-item" href="{{ route('expense.edit', $expense) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-4">
                                @if ($expense->client)
                                    <div class="text-center mb-10">
                                        <div class="symbol symbol-60 symbol-circle symbol-xl-90">
                                            <div class="symbol-label" 
                                                @if ($expense->client->image)
                                                    style="background-image:url({{ Storage::url($expense->client->image->url) }}" 
                                                @else
                                                    style="background-image:url({{ asset('assets/media/users/blank.png') }}" 
                                                @endif
                                                >
                                            </div>
                                        </div>
                                        <div class="text-muted mb-2">{{ $expense->client->name }} @if ($expense->client->company) ({{ $expense->client->company }}) @endif</div>
                                    </div>
                                @else 
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Cliente:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">Ninguno</span>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Cuenta:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $expense->account->name }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Categoría de gasto:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">
                                            @if ($expense->categoryExpense)
                                                {{$expense->categoryExpense->name}}
                                            @else
                                                <span class="badge badge-secondary">Sin categoría</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">monto:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $expense->montoToString() }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Concepto:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $expense->concept }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Nota:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $expense->note }}</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets') }}/media/svg/shapes/abstract-4.svg)">
                            <!--begin::Body-->
                            <div class="card-body">
                                @if ($expense->user)
                                    <a href="{{ route('user.show', $expense->user) }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">gasto realizado por</a>
                                    <div class="">
                                        <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">
                                            @if ($expense->user)
                                                <span class="badge badge-info">{{ $expense->user->name }}</span>
                                            @else
                                                <span class="badge badge-secondary">Ninguno</span>
                                            @endif
                                        </p> 
                                        <br>
                                        <div class="font-weight-bold text-success mb-5">{{ $expense->created_at->diffforhumans() }} ({{ $expense->createdAtToString() }})</div>
                                    </div>
                                @else
                                    <span class="badge badge-secondary">El usuario que realizó el gasto fue eliminado</span>
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
                                    <h3 class="card-label">Servicios asociados a este gasto</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group m-0">
                                    <div class="row">
                                        @forelse ($expense->services as $service)
                                        <div class="col-lg-6">
                                            <a href="{{ route('service.show', $service) }}">
                                                <label class="option" style="cursor: pointer;">
                                                    <span class="option-label">
                                                        <span class="option-head">
                                                            <span class="option-title">{{ $service->name }}</span>
                                                            <span class="option-focus">{{ $service->priceToString() }}</span>
                                                        </span>
                                                        <span class="option-body">{{ $service->note }}</span>
                                                    </span>
                                                </label>
                                            </a>
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
                                    <h3 class="card-label">Comprobante de gasto</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($expense->image)
                                    <img class="img-fluid" src="{{ Storage::url($expense->image->url) }}" />
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