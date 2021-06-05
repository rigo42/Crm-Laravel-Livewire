@extends('layouts.main')

@section('title', 'Dasboard')

@section('content')

    <!--begin::page-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        
        <!--begin::Bread-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-2 mr-5">Dashoboard</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item active">
                                <a href="#" class="text-muted">General</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
            </div>
        </div>
        
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
            <!--begin::Dashboard-->

                <div class="row mb-5">
                    <div class="col-lg-3">
                        <!--begin::Iconbox-->
                        <div class="card card-custom wave wave-animate-slow wave-danger mb-8 mb-lg-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-5">
                                    <div class="mr-6">
                                        <span class="symbol symbol-35 symbol-danger">
                                            <span class="symbol-label font-size-h5 font-weight-bold"><i class="fas fa-dollar-sign text-white"></i></span>
                                        </span>
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
                                            
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span href="#" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">$50,000</span>
                                        <div class="text-dark-75 font-weight-bold font-size-h5" >Cantidad debida</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Iconbox-->
                    </div>
                    <div class="col-lg-3">
                        <!--begin::Iconbox-->
                        <div class="card card-custom wave wave-animate-slow wave-primary mb-8 mb-lg-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-5">
                                    <div class="mr-6">
                                        <span class="symbol symbol-35 symbol-primary">
                                            <span class="symbol-label font-size-h5 font-weight-bold"><i class="fas fa-users text-white"></i></span>
                                        </span>
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
                                            
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span href="#" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">10</span>
                                        <div class="text-dark-75 font-weight-bold font-size-h5" >Clientes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Iconbox-->
                    </div>
                    <div class="col-lg-3">
                        <!--begin::Iconbox-->
                        <div class="card card-custom wave wave-animate-slow wave-primary mb-8 mb-lg-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-5">
                                    <div class="mr-6">
                                        <span class="symbol symbol-35 symbol-primary">
                                            <span class="symbol-label font-size-h5 font-weight-bold"><i class="fas fa-file-pdf text-white"></i></span>
                                        </span>
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
                                            
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span href="#" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">10</span>
                                        <div class="text-dark-75 font-weight-bold font-size-h5" >Facturas</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Iconbox-->
                    </div>
                    <div class="col-lg-3">
                        <!--begin::Iconbox-->
                        <div class="card card-custom wave wave-animate-slow wave-primary mb-8 mb-lg-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-5">
                                    <div class="mr-6">
                                        <span class="symbol symbol-35 symbol-primary">
                                            <span class="symbol-label font-size-h5 font-weight-bold"><i class="fa fa-sticky-note text-white"></i></span>
                                        </span>
                                        <span class="svg-icon svg-icon-primary svg-icon-4x">
                                            
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span href="#" class="text-dark text-hover-danger font-weight-bold font-size-h4 mb-3">5</span>
                                        <div class="text-dark-75 font-weight-bold font-size-h5" >Presupuestos</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Iconbox-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">Gastos de venta
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div id="kt_flotcharts_1" style="height: 300px;"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-body pt-0">
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
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <!--begin::Advance Table Widget 3-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Facturas adeudadas</span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm">(15) Factura(s) adeudadas</span>
                                </h3>
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-success font-weight-bolder font-size-sm">Ver todo</a>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-0 pb-3">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th >Cliente</th>
                                                <th >
                                                Vencimiento
                                                </th>
                                                <th >Status</th>
                                                <th >Cantidad debida</th>
                                                <th >Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="pl-0 py-8">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-50 flex-shrink-0 mr-4">
                                                            <div class="symbol-label" style="background-image: url('{{ asset('assets') }}/media/stock-600x400/img-26.jpg')"></div>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Nicole torres</a>
                                                            <span class="text-muted font-weight-bold d-block">Persona</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">31 de julio 2021</span>
                                                </td>
                                                <td>
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg badge badge-secondary">Borrador</span>
                                                </td>
                                                <td>
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$40.00</span>
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
                                            <tr>
                                                <td class="pl-0 py-8">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-50 flex-shrink-0 mr-4">
                                                            <div class="symbol-label" style="background-image: url('{{ asset('assets') }}/media/stock-600x400/img-26.jpg')"></div>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Nicole torres</a>
                                                            <span class="text-muted font-weight-bold d-block">Persona</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">31 de julio 2021</span>
                                                </td>
                                                <td>
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg badge badge-secondary">Borrador</span>
                                                </td>
                                                <td>
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$40.00</span>
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
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!--begin::Advance Table Widget 3-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Presupuestos recientes</span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm">(85) Presupuestos en total</span>
                                </h3>
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-success font-weight-bolder font-size-sm">Ver todo</a>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-0 pb-3">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th >Cliente</th>
                                                <th >Fecha</th>
                                                <th >Status</th>
                                                <th >Cantidad debida</th>
                                                <th >Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="pl-0 py-8">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-50 flex-shrink-0 mr-4">
                                                            <div class="symbol-label" style="background-image: url('{{ asset('assets') }}/media/stock-600x400/img-26.jpg')"></div>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Nicole torres</a>
                                                            <span class="text-muted font-weight-bold d-block">Persona</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">31 de julio 2021</span>
                                                </td>
                                                <td>
                                                    <span class="text-white-75 font-weight-bolder d-block font-size-lg badge badge-primary">Aceptado</span>
                                                </td>
                                                <td>
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$50.00</span>
                                                </td>
                                                <td class="text-right pr-0">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" style="position: initial!important;">
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
                                                                    <li class="navi-item">
                                                                        <a href="#" class="navi-link">
                                                                            <span class="navi-icon">
                                                                                <i class="fas fa-file-pdf"></i>
                                                                            </span>
                                                                            <span class="navi-text">Convertir a factura</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="navi-item">
                                                                        <a href="#" class="navi-link">
                                                                            <span class="navi-icon">
                                                                                <i class="fas fa-check-circle"></i>
                                                                            </span>
                                                                            <span class="navi-text">Marcar como aceptado</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="navi-item">
                                                                        <a href="#" class="navi-link">
                                                                            <span class="navi-icon">
                                                                                <i class="fas fa-times-circle"></i>
                                                                            </span>
                                                                            <span class="navi-text">Marcar como rechazado</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="navi-item">
                                                                        <a href="#" class="navi-link">
                                                                            <span class="navi-icon">
                                                                                <i class="fa fa-trash"></i>
                                                                            </span>
                                                                            <span class="navi-text">Eliminar</span>
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
                            <!--end::Body-->
                        </div>
                    </div>
                </div>

            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@endsection

@section('footer')
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets') }}/plugins/custom/flot/flot.bundle.js"></script>
    <script src="{{ asset('assets') }}/js/pages/features/charts/flotcharts.js"></script>
@endsection