
<!--begin::Wrapper-->
<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header header-fixed">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-end">
            <!--begin::Topbar-->
            <div class="topbar">

                @livewire('layouts.rightsidebar.search')

                @livewire('layouts.rightsidebar.profile')

            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->

    @yield('content')

    @include('layouts.footer')

</div>
<!--end::Wrapper-->