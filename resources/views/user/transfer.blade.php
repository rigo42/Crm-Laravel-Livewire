@extends('layouts.main')

@section('title', 'Transferir de '.$user->name)

@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                <span></span>
            </button>
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">@yield('title')</h5>
            </div>
        </div>
    </div>
</div>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="d-flex flex-row">
                
                @include('user.menu.index')

                <div class="flex-row-fluid ml-lg-8">
                    
                    @livewire('user.transfer', ['user' => $user], key($user->id))

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