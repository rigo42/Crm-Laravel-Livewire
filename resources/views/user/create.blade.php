@extends('layouts.main')

@section('title', 'Nuevo usuario')

@section('content')

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <a class="text-dark" href="{{ route('user.index') }}"><h5 class="text-dark font-weight-bold my-2 mr-5">Usuarios</h5></a>
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
        <div class="container-fluid">
            <div class="d-flex flex-row">

                <div class="flex-row-fluid ml-lg-8">
                    @livewire('user.form', ['user' => $user, 'method' => 'store'])   
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('assets') }}/js/pages/widgets.js"></script>
<script src="{{ asset('assets') }}/js/pages/custom/profile/profile.js"></script>
@endsection