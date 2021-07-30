@extends('layouts.main')

@section('title', 'Reportes')

@section('content')
    <!--begin::Bread-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader" style="margin-bottom: 0px;">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <a href="#"><h5 class="text-dark font-weight-bold my-2 mr-5">@yield('title')</h5></a>
                </div>
            </div>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding: 0px;">
        <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top" style="background-image: url('assets/media/bg/bg-9.jpg')">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center pt-25 pb-35">
                    <h3 class="font-weight-bolder text-dark mb-0">Buen día {{ explode (" ", auth()->user()->name)[0] }}</h3>
                    {{--  b --}}
                </div>
            </div>
        </div>

        @livewire('report.index')

    </div>


@endsection