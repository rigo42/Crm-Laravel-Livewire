@extends('layouts.main')

@section('title', $service->name)

@section('content')
    <!--begin::Bread-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <a class="text-dark" href="{{ route('service.index') }}"><h5 class="text-dark font-weight-bold my-2 mr-5">Servicios</h5></a>
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
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="d-flex">
                            <!--begin: Pic-->
                            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                <div class="symbol symbol-50 symbol-lg-120">
                                    <img class="img-fluid" alt="{{ $service->client->name }}" 
                                        @if ($service->client->image)
                                            src="{{ Storage::url($service->client->image->url) }}" 
                                        @else
                                            src="{{ asset('assets/media/users/blank.png') }}" 
                                        @endif
                                    />
                                </div>
                            </div>
                            <!--end: Pic-->
                            <!--begin: Info-->
                            <div class="flex-grow-1">
                                <!--begin: Title-->
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="mr-3">
                                        <!--begin::Name-->
                                        <a href="{{ route('client.show', $service->client) }}" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $service->client->name }}</a>
                                        <!--end::Name-->
                                        <!--begin::Contacts-->
                                        <div class="d-flex flex-wrap my-2">
                                            <a href="mailto:{{ $service->client->email }}" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                        <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>{{ $service->client->email }}</a>
                                            <a href="tel:+{{ $service->client->phone }}" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Phone.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M7.13888889,4 L7.13888889,19 L16.8611111,19 L16.8611111,4 L7.13888889,4 Z M7.83333333,1 L16.1666667,1 C17.5729473,1 18.25,1.98121694 18.25,3.5 L18.25,20.5 C18.25,22.0187831 17.5729473,23 16.1666667,23 L7.83333333,23 C6.42705272,23 5.75,22.0187831 5.75,20.5 L5.75,3.5 C5.75,1.98121694 6.42705272,1 7.83333333,1 Z" fill="#000000" fill-rule="nonzero"/>
                                                        <polygon fill="#000000" opacity="0.3" points="7 4 7 19 17 19 17 4"/>
                                                        <circle fill="#000000" cx="12" cy="21" r="1"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>{{ $service->client->phone }}
                                            </a>
                                            <a href="#" class="text-muted text-hover-primary font-weight-bold">
                                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                    <i class="fas fa-tag"></i>
                                                    
                                                </span>
                                                @if ($service->categoryService->name)
                                                    {{ $service->categoryService->name }}
                                                @else
                                                    Ninguna categoría
                                                @endif
                                            </a>
                                        </div>
                                        <!--end::Contacts-->
                                    </div>
                                    <div class="my-lg-0 my-1">
                                         <!--start::Toolbar-->
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('service.edit', $service) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Title-->
                                @if ($service->has_invoice)
                                <div class="d-block  mr-7">
                                    <a href="#" class="font-weight-bolder badge badge-info ml-2">Se require factura</a>
                                </div>
                                @endif
                                <!--begin: Content-->
                                <div class="d-flex align-items-center flex-wrap justify-content-between">
                                    <div class="flex-grow-1 font-weight-bold text-dark-50 py-5 py-lg-2 mr-5">{{ $service->note }}</div>
                                   
                                    <div class="d-flex flex-wrap align-items-center py-2">
                                        <div class="d-flex align-items-center mr-10">
                                            <div class="mr-6">
                                                <div class="font-weight-bold mb-2">Inicio</div>
                                                <span class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">{{ $service->start() }}</span>
                                            </div>
                                            <div class="">
                                                <div class="font-weight-bold mb-2">Vencimiento</div>
                                                <span class="btn btn-sm btn-text btn-light-danger text-uppercase font-weight-bold">{{ $service->due() }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 flex-shrink-0 w-150px w-xl-300px mt-4 mt-sm-0">
                                            @if ($service->type == 'Proyecto')
                                                <span class="font-weight-bold">Progreso</span>
                                                <div class="progress progress-xs mt-2 mb-2">
                                                    @if ($service->progressByProject() >= 60)
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $service->progressByProject() }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    @elseif($service->progressByProject() >= 30)
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $service->progressByProject() }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    @else
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $service->progressByProject() }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    @endif
                                                </div>
                                                <span class="font-weight-bolder text-dark">{{ $service->progressByProject() }}%</span>
                                            @else     
                                            <div class="mr-6">
                                                <div class="font-weight-bold mb-2">Días restantes</div>
                                                <span class="btn btn-sm btn-text btn-light-dark text-uppercase font-weight-bold">{{ $service->progressByMohts() }}</span>
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <!--end: Content-->
                            </div>
                            <!--end: Info-->
                        </div>
                       
                        <div class="separator separator-solid my-7"></div>

                        <div class="d-flex align-items-center justify-content-start flex-wrap mt-5">
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-bold nav-tabs-line-3x" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                    <i class="fa fa-chart-bar"></i>
                                                </span>
                                            </span>
                                            <span class="nav-text">Estadisticas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                    <i class="fa fa-credit-card"></i>
                                                </span>
                                            </span>
                                            <span class="nav-text">Pagos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                <i class="fa fa-calculator"></i>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="nav-text">Gastos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                <i class="fa fa-sticky-note"></i>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="nav-text">Acuerdo de servicio</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_5">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                    <i class="fas fa-file-pdf"></i>
                                                </span>
                                            </span>
                                            <span class="nav-text">Facturas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_6">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                    <i class="fa fa-users"></i>
                                                </span>
                                            </span>
                                            <span class="nav-text">Usuarios</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card-->
                <!--begin::Body-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-body px-0">
                        <div class="tab-content ">
                            <!--begin::Tab Content-->
                            <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                                <div class="container">
                                    
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-4 d-flex flex-column">
                                                <!--begin::Block-->
                                                <div class="bg-light-warning p-8 rounded-xl flex-grow-1">
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-circle symbol-white symbol-30 flex-shrink-0 mr-3">
                                                            <div class="symbol-label">
                                                                <span class="svg-icon svg-icon-md svg-icon-danger">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                            <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-size-sm font-weight-bold">$2800</div>
                                                            <div class="font-size-sm text-muted">Weekly CoreAd Sales</div>
                                                        </div>
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-circle symbol-white symbol-30 flex-shrink-0 mr-3">
                                                            <div class="symbol-label">
                                                                <span class="svg-icon svg-icon-md svg-icon-info">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                                                            <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-size-sm font-weight-bold">490</div>
                                                            <div class="font-size-sm text-muted">Manuals Added</div>
                                                        </div>
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-circle symbol-white symbol-30 flex-shrink-0 mr-3">
                                                            <div class="symbol-label">
                                                                <span class="svg-icon svg-icon-md svg-icon-warning">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flip-vertical.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <path d="M9.07117914,12.5710461 L13.8326627,12.5710461 C14.108805,12.5710461 14.3326627,12.3471885 14.3326627,12.0710461 L14.3326627,0.16733734 C14.3326627,-0.108805035 14.108805,-0.33266266 13.8326627,-0.33266266 C13.6282104,-0.33266266 13.444356,-0.208187188 13.3684243,-0.0183579985 L8.6069408,11.8853508 C8.50438409,12.1417426 8.62909204,12.4327278 8.8854838,12.5352845 C8.94454394,12.5589085 9.00756943,12.5710461 9.07117914,12.5710461 Z" fill="#000000" opacity="0.3" transform="translate(11.451854, 6.119192) rotate(-270.000000) translate(-11.451854, -6.119192)" />
                                                                            <path d="M9.23851648,24.5 L14,24.5 C14.2761424,24.5 14.5,24.2761424 14.5,24 L14.5,12.0962912 C14.5,11.8201488 14.2761424,11.5962912 14,11.5962912 C13.7955477,11.5962912 13.6116933,11.7207667 13.5357617,11.9105959 L8.77427814,23.8143047 C8.67172143,24.0706964 8.79642938,24.3616816 9.05282114,24.4642383 C9.11188128,24.4878624 9.17490677,24.5 9.23851648,24.5 Z" fill="#000000" transform="translate(11.500000, 18.000000) scale(1, -1) rotate(-270.000000) translate(-11.500000, -18.000000)" />
                                                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="11" y="2" width="2" height="20" rx="1" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-size-sm font-weight-bold">34,300</div>
                                                            <div class="font-size-sm text-muted">Emails Received</div>
                                                        </div>
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-circle symbol-white symbol-30 flex-shrink-0 mr-3">
                                                            <div class="symbol-label">
                                                                <span class="svg-icon svg-icon-md svg-icon-success">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Cupboard.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <path d="M3.5,3 L9.5,3 C10.3284271,3 11,3.67157288 11,4.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L3.5,20 C2.67157288,20 2,19.3284271 2,18.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z M9,9 C8.44771525,9 8,9.44771525 8,10 L8,12 C8,12.5522847 8.44771525,13 9,13 C9.55228475,13 10,12.5522847 10,12 L10,10 C10,9.44771525 9.55228475,9 9,9 Z" fill="#000000" opacity="0.3" />
                                                                            <path d="M14.5,3 L20.5,3 C21.3284271,3 22,3.67157288 22,4.5 L22,18.5 C22,19.3284271 21.3284271,20 20.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,4.5 C13,3.67157288 13.6715729,3 14.5,3 Z M20,9 C19.4477153,9 19,9.44771525 19,10 L19,12 C19,12.5522847 19.4477153,13 20,13 C20.5522847,13 21,12.5522847 21,12 L21,10 C21,9.44771525 20.5522847,9 20,9 Z" fill="#000000" transform="translate(17.500000, 11.500000) scale(-1, 1) translate(-17.500000, -11.500000)" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-size-sm font-weight-bold">550</div>
                                                            <div class="font-size-sm text-muted">Meetups Completed</div>
                                                        </div>
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-circle symbol-white symbol-30 flex-shrink-0 mr-3">
                                                            <div class="symbol-label">
                                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
                                                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
                                                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
                                                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-size-sm font-weight-bold">$346,000</div>
                                                            <div class="font-size-sm text-muted">Total Author Sales</div>
                                                        </div>
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-white symbol-30 flex-shrink-0 mr-3">
                                                            <div class="symbol-label">
                                                                <span class="svg-icon svg-icon-md svg-icon-danger">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Pound.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <path d="M7.825,10.225 C7.2,9.475 6.85,8.4 6.85,7.375 C6.85,4.55 9.15,2.05 12.35,2.05 C15.45,2.05 17.8,4.45 17.875,7.425 L15.075,7.425 C15.075,5.85 13.975,4.6 12.35,4.6 C10.75,4.6 9.6,5.775 9.6,7.375 C9.6,8.26626781 10.0162926,9.06146809 10.6676674,9.58392078 C10.7130614,9.62033024 10.7238389,12.2340233 10.7,17.425 L17.5444449,17.425 C17.8205873,17.425 18.0444449,17.6488576 18.0444449,17.925 C18.0444449,17.9869142 18.0329457,18.0482899 18.0105321,18.1060047 L17.3988817,19.6810047 C17.3242018,19.8733052 17.1390868,20 16.9327944,20 L6.3,20 C6.02385763,20 5.8,19.7761424 5.8,19.5 L5.8,17.925 C5.8,17.6488576 6.02385763,17.425 6.3,17.425 L7.925,17.425 L7.925,12.475 L7.825,10.225 Z" fill="#000000" />
                                                                            <path d="M4.3618034,11.2763932 L4.8618034,10.2763932 C4.94649941,10.1070012 5.11963097,10 5.30901699,10 L15.190983,10 C15.4671254,10 15.690983,10.2238576 15.690983,10.5 C15.690983,10.5776225 15.6729105,10.6541791 15.6381966,10.7236068 L15.1381966,11.7236068 C15.0535006,11.8929988 14.880369,12 14.690983,12 L4.80901699,12 C4.53287462,12 4.30901699,11.7761424 4.30901699,11.5 C4.30901699,11.4223775 4.32708954,11.3458209 4.3618034,11.2763932 Z" fill="#000000" opacity="0.3" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-size-sm font-weight-bold">560</div>
                                                            <div class="font-size-sm text-muted">Total Transactions</div>
                                                        </div>
                                                    </div>
                                                    <!--end::Item-->
                                                </div>
                                                <!--end::Block-->
                                            </div>
                                            <div class="col-xl-8">
                                                <div id="kt_charts_widget_6_chart"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end::Tab Content-->
                            <!--begin::Tab Content-->
                            <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                                <!--begin::Body-->
                                <div class="card-body pt-0 pb-3">
                                    <div class="my-3">
                                        <span class="text-muted font-weight-bold font-size-sm">(15) pago(s)</span>
                                    </div>
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                            <thead>
                                                <tr class="text-uppercase">
                                                    <th>Monto</th>
                                                    <th>Fecha de pago</th>
                                                    <th>Servicio</th>
                                                    <th>Nota personal</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$800</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">31 de julio 2021</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg ">Página web</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Esta es una nota personal</span>
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
                                                                            <a href="#" class="navi-link">
                                                                                <span class="navi-icon">
                                                                                    <i class="fa fa-pen"></i>
                                                                                </span>
                                                                                <span class="navi-text">Editar</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
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
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Tab Content-->
                            <!--begin::Tab Content-->
                            <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                                <!--begin::Body-->
                                <div class="card-body pt-0 pb-3">
                                    <div class="my-3">
                                        <span class="text-muted font-weight-bold font-size-sm">(15) gasto(s)</span>
                                    </div>
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                            <thead>
                                                <tr class="text-uppercase">
                                                    <th>Monto</th>
                                                    <th>Fecha de gasto</th>
                                                    <th>Categoría</th>
                                                    <th>Nota personal</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$800</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">31 de julio 2021</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg ">Página web</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Esta es una nota personal</span>
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
                                                                            <a href="#" class="navi-link">
                                                                                <span class="navi-icon">
                                                                                    <i class="fa fa-pen"></i>
                                                                                </span>
                                                                                <span class="navi-text">Editar</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
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
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                                <div class="container">
                                    @if ($service->service_agreement)
                                        <embed src="{{ Storage::url($service->service_agreement) }}" type="" width="100%" height="600px">
                                    @else
                                        <span class="badge badge-secondary">Sin acuerdo de servicio</span>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_apps_contacts_view_tab_5" role="tabpanel">
                                <div class="container">
                                    
                                </div>
                            </div>
                            <!--end::Tab Content-->
                            <!--begin::Tab Content-->
                            <div class="tab-pane" id="kt_apps_contacts_view_tab_6" role="tabpanel">
                                @livewire('service.user', ['service' => $service], key($service->id))
                            </div>
                            <!--end::Tab Content-->
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Container-->
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('assets') }}/js/pages/widgets.js"></script>
@endsection