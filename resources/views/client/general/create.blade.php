@extends('layouts.app')

@section('title', 'Clientes')

@section('head')
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('assets') }}/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--begin::Bread-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <a class="text-dark" href="{{ route('client.index') }}"><h5 class="text-dark font-weight-bold my-2 mr-5">@yield('title')</h5></a>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item active">
                            <a href="#" class="text-muted">Nuevo</a>
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
            <div class="container">
                @livewire('client.general.form', ['method' => 'store'])
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@endsection