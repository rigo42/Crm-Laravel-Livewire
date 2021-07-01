<div>  
    
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header h-auto border-0">
                    <div class="card-title py-5">
                        <h3 class="card-label">
                            <span class="d-block text-dark font-weight-bolder">Grafica general</span>
                            <span class="d-block text-muted mt-2 font-size-sm">Año ({{ date('Y') }})</span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <span class="mr-5 d-flex align-items-center font-weight-bold">
                        <i class="label label-dot label-xl label-success mr-2"></i>Pagos</span>
                        <span class="d-flex align-items-center font-weight-bold">
                        <i class="label label-dot label-xl label-danger mr-2"></i>Gastos</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="kt_charts_widget_1_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>

    
    
    @push('footer')
        <script>
            "use strict";

            // Class definition
            // var KTWidgets = function() {

                // Charts widgets
                // var _initChartsWidget1 = function() {
                    var element = document.getElementById("kt_charts_widget_1_chart");

                    if (!element) {
                        return;
                    }

                    var options = {
                        series: [{
                            name: 'Pagos',
                            data: [
                                @foreach ($payments as $payment)
                                    {{ $payment }},
                                @endforeach
                            ]
                        }, {
                            name: 'Gastos',
                            data: [
                                @foreach ($expenses as $expense)
                                    {{ $expense }},
                                @endforeach
                            ]
                        }],
                        chart: {
                            type: 'bar',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: ['20%'],
                                endingShape: 'rounded'
                            },
                        },
                        legend: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: [
                                @foreach ($months as $month)
                                    '{{ $month["name"] }}',
                                @endforeach
                            ],
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false
                            },
                            labels: {
                                style: {
                                    colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                                    fontSize: '12px',
                                    fontFamily: KTApp.getSettings()['font-family']
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                                    fontSize: '12px',
                                    fontFamily: KTApp.getSettings()['font-family']
                                }
                            }
                        },
                        fill: {
                            opacity: 1
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
                                fontFamily: KTApp.getSettings()['font-family']
                            },
                            // y: {
                            //     formatter: function(val) {
                            //         return "$" + val + " thousands"
                            //     }
                            // }
                        },
                        colors: ['#1BC5BD', '#f64e60'],
                        grid: {
                            borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                            strokeDashArray: 4,
                            yaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        }
                    };

                    var chart = new ApexCharts(element, options);
                    chart.render();
                // }

                // // Public methods
                // return {
                //     init: function() {
                //         // Charts Widgets
                //         _initChartsWidget1();
                //     }
                // }
            // }();

            // Webpack support
            // if (typeof module !== 'undefined') {
            //     module.exports = KTWidgets;
            // }

            // jQuery(document).ready(function() {
            //     KTWidgets.init();
            // });
        </script>
    @endpush

</div>
