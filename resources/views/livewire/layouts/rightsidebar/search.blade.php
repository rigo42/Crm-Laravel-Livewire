
<div class="dropdown" id="kt_quick_search_toggle" >
    <!--begin::Toggle-->
    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
        <div class="btn btn-icon btn-clean btn-lg btn-dropdown mr-1">
            <i class="fa fa-search"></i>
        </div>
    </div>
    <!--end::Toggle-->
    <!--begin::Dropdown-->
    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
        <div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
            <!--begin:Form-->
            <form method="get" class="quick-search-form">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="svg-icon svg-icon-lg">
                                <i class="fa fa-search"></i>
                            </span>
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search..." />
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="quick-search-close ki ki-close icon-sm text-muted"></i>
                        </span>
                    </div>
                </div>
            </form>
            <!--end::Form-->
            <!--begin::Scroll-->
            <div class="scroll" data-scroll="true" data-height="325" data-mobile-height="200">
                <div class="quick-search-result">
                    {{-- Section --}}
                    <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                        Members
                    </div>
                    <div class="mb-10">
                        <div class="d-flex align-items-center flex-grow-1 mb-2">
                            <div class="symbol symbol-30  flex-shrink-0">
                                <div class="symbol-label" style="background-image:url('{{ asset('media/users/300_20.jpg') }}')"></div>
                            </div>
                            <div class="d-flex flex-column ml-3 mt-2 mb-2">
                                <a href="#" class="font-weight-bold text-dark text-hover-primary">
                                Milena Gibson
                                </a>
                                <span class="font-size-sm font-weight-bold text-muted">
                                UI Designer
                                </span>
                            </div>
                        </div>                                    
                    </div>
                </div>
            </div>
            <!--end::Scroll-->
        </div>
    </div>
    <!--end::Dropdown-->
</div>