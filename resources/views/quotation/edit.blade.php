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
                        <li class="breadcrumb-item">
                            <a href="{{ route('quotation.show', $quotation) }}" class="text-muted">@yield('title')</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="#" class="text-muted">Editar</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            @livewire('quotation.form', ['quotation' => $quotation, 'method' => 'update'])
        </div>
    </div>
@endsection

@section('footer')

@endsection