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

                {{-- Graph stat --}}
                @livewire('dashboard.graph-stat')

                {{-- Graph general --}}
                @livewire('dashboard.graph')


                <div class="row">
                    @can('servicios')
                        <div class="col-lg-12">
                            <!--begin::Advance Table Widget 3-->
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0 py-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder text-dark">Cortes de la semana</span>
                                        <span class="text-muted mt-3 font-weight-bold font-size-sm">({{ $servicesCutThisWeek->count() }}) Corte(s) {{ \Carbon\Carbon::now()->startOfWeek()->format('d-m-Y') }} - {{ \Carbon\Carbon::now()->endOfWeek()->format('d-m-Y') }}</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <a href="{{ route('service.index') }}" class="btn btn-success font-weight-bolder font-size-sm">Ver todo</a>
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
                                                    <th >Día de corte</th>
                                                    <th >Servicio</th>
                                                    <th >Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($servicesCutThisWeek as $service)
                                                    <tr>
                                                        <td class="pl-0 py-8">
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-50 flex-shrink-0 mr-4">
                                                                    <div 
                                                                        class="symbol-label" 
                                                                        @if ($service->client->image)
                                                                            style="background-image: url('{{ Storage::url($service->client->image->url) }}')"
                                                                        @else
                                                                            style="background-image: url('{{ asset('assets/media/users/blank.png') }}')"
                                                                        @endif
                                                                    ></div>
                                                                </div>
                                                                <div>
                                                                    <a href="{{ route('client.show', $service->client) }}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $service->client->name }}</a>
                                                                    <span class="text-muted font-weight-bold d-block">{{ $service->client->company }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-danger font-weight-bolder d-block font-size-lg mr-2">{{ $service->due() }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $service->name  }} ({{ $service->categoryService->name }})</span>
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
                                                                                <a href="{{ route('service.edit', $service) }}" class="navi-link">
                                                                                    <span class="navi-icon">
                                                                                        <i class="fa fa-pen"></i>
                                                                                    </span>
                                                                                    <span class="navi-text">Editar</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="navi-item">
                                                                                <a href="{{ route('service.show', $service) }}" class="navi-link">
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
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Body-->
                            </div>
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
