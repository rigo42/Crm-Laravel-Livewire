@extends('layouts.main')

@section('title', 'Dasboard')

@section('content')
    <!--begin::Bread-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Dashoboard</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item active">
                            <a href="#" class="text-muted">General </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--begin::page-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
            <!--begin::Dashboard-->

                @can('reportes')
                    {{-- Graph stat --}}
                    @livewire('dashboard.graph-stat')

                    {{-- Graph general --}}
                    @livewire('dashboard.graph')
                @endcan
                
                <div class="row">
                    @can('pagos')
                        <div class="col-lg-4 col-xxl-4 order-1 order-xxl-2">
                            <!--begin::List Widget 3-->
                            <div class="card card-custom card-stretch gutter-b">
                                 <!--begin::Header-->
                                 <div class="card-header border-0 py-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder text-dark">Cortes hoy</span>
                                        <span class="text-muted mt-3 font-weight-bold font-size-sm">({{ $servicesCutThisDay->count() }}) Corte(s) {{ \Carbon\Carbon::now()->toFormattedDateString() }} </span>
                                    </h3>
                                </div>
                                
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-2">
                                    @foreach ($servicesCutThisDay as $service)
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-10">
                                            <!--begin::Symbol-->
                                            <div
                                                class="symbol symbol-50 flex-shrink-0 mr-4 mr-2"
                                            >
                                                <img 
                                                    width="40px"
                                                    @if ($service->client->image)
                                                        src='{{ Storage::url($service->client->image->url) }}'
                                                    @else
                                                        src='{{ asset('assets/media/users/blank.png') }}'
                                                    @endif
                                                    class="h-75 align-self-end" alt=""
                                                >
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                                                <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{ $service->client->name }}</a> <span class="text-secondary font-size-sm">{{ $service->client->company }}</span> 
                                                <span class="text-muted">Día {{ $service->due_day }}</span>
                                                <span class="text-muted">Servicio: {{ $service->categoryService->name }}</span> 
                                            </div>
                                            <!--end::Text-->
                                            <!--begin::Dropdown-->
                                            <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                                <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" style="">
                                                    <!--begin::Navigation-->
                                                    <ul class="navi navi-hover">
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-text">
                                                                    <i class="fa fa-credit-card"></i>
                                                                    Generar pago
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <!--end::Navigation-->
                                                </div>
                                            </div>
                                            <!--end::Dropdown-->
                                        </div>
                                        <!--end::Item-->
                                    @endforeach
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 3-->
                        </div>
                        <div class="col-lg-4 col-xxl-4 order-1 order-xxl-2">
                            <!--begin::List Widget 3-->
                            <div class="card card-custom card-stretch gutter-b">
                                 <!--begin::Header-->
                                 <div class="card-header border-0 py-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder text-dark">Cortes de la semana</span>
                                        <span class="text-muted mt-3 font-weight-bold font-size-sm">({{ $servicesCutThisWeek->count() }}) Corte(s) {{ \Carbon\Carbon::now()->startOfWeek()->toFormattedDateString() }} - {{ \Carbon\Carbon::parse('friday')->endOfDay()->toFormattedDateString() }}</span>
                                    </h3>
                                </div>
                                
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-2">
                                    @foreach ($servicesCutThisWeek as $service)
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-10">
                                            <!--begin::Symbol-->
                                            <div
                                                class="symbol symbol-50 flex-shrink-0 mr-4 mr-2"
                                            >
                                                <img 
                                                    width="40px"
                                                    @if ($service->client->image)
                                                        src='{{ Storage::url($service->client->image->url) }}'
                                                    @else
                                                        src='{{ asset('assets/media/users/blank.png') }}'
                                                    @endif
                                                    class="h-75 align-self-end" alt=""
                                                >
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                                                <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{ $service->client->name }}</a> <span class="text-secondary font-size-sm">{{ $service->client->company }}</span> 
                                                <span class="text-muted">Día {{ $service->due_day }}</span>
                                                <span class="text-muted">Servicio: {{ $service->categoryService->name }}</span> 
                                            </div>
                                            <!--end::Text-->
                                            <!--begin::Dropdown-->
                                            <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                                <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" style="">
                                                    <!--begin::Navigation-->
                                                    <ul class="navi navi-hover">
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-text">
                                                                    <i class="fa fa-credit-card"></i>
                                                                    Generar pago
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <!--end::Navigation-->
                                                </div>
                                            </div>
                                            <!--end::Dropdown-->
                                        </div>
                                        <!--end::Item-->
                                    @endforeach
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 3-->
                        </div>
                        <div class="col-lg-4 col-xxl-4 order-1 order-xxl-2">
                            <!--begin::List Widget 3-->
                            <div class="card card-custom card-stretch gutter-b">
                                 <!--begin::Header-->
                                 <div class="card-header border-0 py-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder text-dark">Cortes atrasados {{ \Carbon\Carbon::now()->startOfWeek()->subDay(1)->format('y-m-d') }}</span>
                                   </h3>
                                </div>
                                
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-2">
                                    @foreach ($servicesCutBack as $service)
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-10">
                                            <!--begin::Symbol-->
                                            <div
                                                class="symbol symbol-50 flex-shrink-0 mr-4 mr-2"
                                            >
                                                <img 
                                                    width="40px"
                                                    @if ($service->client->image)
                                                        src='{{ Storage::url($service->client->image->url) }}'
                                                    @else
                                                        src='{{ asset('assets/media/users/blank.png') }}'
                                                    @endif
                                                    class="h-75 align-self-end" alt=""
                                                >
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                                                <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{ $service->client->name }}</a> <span class="text-secondary font-size-sm">{{ $service->client->company }}</span> 
                                                <span class="text-muted">Día {{ $service->due_day }}</span>
                                                <span class="text-muted">Servicio: {{ $service->categoryService->name }}</span> 
                                            </div>
                                            <!--end::Text-->
                                            <!--begin::Dropdown-->
                                            <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                                <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" style="">
                                                    <!--begin::Navigation-->
                                                    <ul class="navi navi-hover">
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-text">
                                                                    <i class="fa fa-credit-card"></i>
                                                                    Generar pago
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <!--end::Navigation-->
                                                </div>
                                            </div>
                                            <!--end::Dropdown-->
                                        </div>
                                        <!--end::Item-->
                                    @endforeach
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 3-->
                        </div>
                    @endcan
                </div>

            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@endsection
