@extends('layouts.main')

@section('title', 'Google Analytics')

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <a href="#"><h5 class="text-dark font-weight-bold my-2 mr-5">@yield('title')</h5></a>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a target="_blank" href="https://analytics.google.com/analytics/web/" class="btn btn-primary btn-shadow font-weight-bold mr-2 "><i class="fas fa-signal"></i> Ir a Google Analytics</a>
            </div>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            @livewire('google.google-analytics')
        </div>
    </div>

@endsection 