<div class="container">

    <div class="row">
        <div class="col-xl-4">
            <!--begin::Tiles Widget 1-->
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <div class="card-title">
                        <div class="card-label">
                            <div class="font-weight-bolder">Visitantes y visitas a la página del mes</div>
                            <div class="font-size-sm text-muted mt-2">{{ $totalViews }} visitas a {{ config('app.page-domain') }}</div>
                        </div>
                    </div>
                    
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex flex-column px-0">
                    <!--begin::Chart-->
                    <div wire:ignore>
                        <div id="visitorAndPageViewsMostVisited" data-color="danger" style="height: 150px"></div>
                    </div>
                    
                    <!--end::Chart-->
                    <!--begin::Items-->
                    <div class="flex-grow-1 card-spacer-x mt-5">
                        @foreach ($visitorAndPages as $vp)
                             <!--begin::Item-->
                            <div class="d-flex align-items-center justify-content-between mb-10">
                                <div class="d-flex align-items-center mr-2">
                                    <div class=" mr-5 flex-shrink-0">
                                        <i class="fa fa-genderless text-success icon-xxl"></i>
                                    </div>
                                    <div>
                                        <a target="_blank" href="{{ $pageDomain.$vp['url'] }}" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">{{ $vp['pageTitle'] }}</a>
                                        <div class="font-size-sm text-muted font-weight-bold mt-1">{{ $vp['url'] }}</div>
                                    </div>
                                </div>
                                <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">Visitas: {{ $vp['pageViews'] }}</div>
                            </div>
                            <!--end::Item-->
                            
                        @endforeach   
                        {{ $visitorAndPages->links() }}                     
                    </div>
                    <!--end::Items-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Tiles Widget 1-->
        </div>
        <div class="col-xl-4">
            <div class="card card-stretch gutter-b">
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">Visitantes por referencias del mes</h3>
                </div>
                <div class="card-body pt-2">
                   @foreach ($referres as $r)
                   <div class="d-flex align-items-center mb-10">
                        <span class="bullet bullet-bar bg-warning align-self-stretch mr-5"></span>
                        <div class="d-flex flex-column flex-grow-1">
                            <span class="text-dark-75 font-size-sm font-weight-bold font-size-lg mb-1">
                                {{ $r['url'] }}
                            </span>
                            <span class="text-muted font-weight-bold">Visitas: {{ $r['pageViews'] }}</span>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="row">
                <div class="col-xl-6">
                    <!--begin::Tiles Widget 11-->
                    <div class="card card-custom bg-success gutter-b" style="height: 150px">
                        <div class="card-body">
                            <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                        <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">{{ $analyticsData['totalsForAllResults']['ga:sessions'] }}</div>
                            <a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1">Sesiones</a>
                        </div>
                    </div>
                    <!--end::Tiles Widget 11-->
                </div>
                <div class="col-xl-6">
                    <!--begin::Tiles Widget 12-->
                    <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body">
                            <span class="svg-icon svg-icon-3x svg-icon-success">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{ $totalUsers }}</div>
                            <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Usuarios</a>
                        </div>
                    </div>
                    <!--end::Tiles Widget 12-->
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-custom bgi-no-repeat gutter-b" style="background-color: #4AB58E; background-position: calc(100% + 0.5rem) bottom; background-size: 25% auto; background-image: url(assets/media/svg/humans/custom-1.svg)">
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-center">
                            <div class="py-2">
                                <h3 class="text-white font-weight-bolder mb-3">Principales navegadores</h3>
                                <ul>
                                    @foreach ($browsers as $b)
                                        <li  class="text-white font-size-lg">Nombre: {{ $b['browser'] }} - Sesiones: {{ $b['sessions'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('footer')
		<script>

            visitorAndPagesMostViews();

            function visitorAndPagesMostViews(){
                var element = document.getElementById("visitorAndPageViewsMostVisited");
                var height = parseInt(KTUtil.css(element, 'height'));

                var options = {
                    series: [{
                        name: 'Visitas',
                        data: [
                            @foreach($totalVisitorAndPageViews as $tvpv)
                                "{{ $tvpv['pageViews'] }}",
                            @endforeach
                        ]
                    }],
                    chart: {
                        type: 'area',
                        height: height,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {},
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'gradient',
                        opacity: 1,
                        gradient: {

                            type: "vertical",
                            shadeIntensity: 0.55,
                            gradientToColors: undefined,
                            inverseColors: true,
                            opacityFrom: 1,
                            opacityTo: 0.2,
                            stops: [35, 80, 150],
                            colorStops: []
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: ['#d63546']
                    },
                    xaxis: {
                        categories: [
                            @foreach($totalVisitorAndPageViews as $tvpv)
                                "{{ $tvpv['date']->toFormattedDateString() }}",
                            @endforeach
                        ],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: false,
                            style: {
                                fontSize: '12px',
                            }
                        },
                        crosshairs: {
                            show: false,
                            position: 'front',
                            stroke: {
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px',
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            show: false,
                            style: {
                                fontSize: '12px',
                            }
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px',
                        },
                    },
                    colors: ['#fff2f3'],
                    markers: {
                        colors: ['#f3f6f9'],
                        strokeColor: ['#d63546'],
                        strokeWidth: 3
                    },
                    padding: {
                        top: 0,
                        bottom: 0
                    }
                };

                var chart = new ApexCharts(element, options);
                chart.render();
                }

        </script>
    @endpush
</div>
