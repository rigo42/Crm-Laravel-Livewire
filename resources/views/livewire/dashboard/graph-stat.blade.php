<div>
    <div class="row mb-5">
        <div class="col-xl-4">
            <!--begin::Stats Widget 8-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Authors Progress</a>
                            <span class="text-muted font-weight-bold mt-2">Marketplace Authors Chart</span>
                        </div>
                        <span class="symbol symbol-light-danger symbol-45">
                            <span class="symbol-label font-weight-bolder font-size-h6">+94</span>
                        </span>
                    </div>
                    <div id="kt_stats_widget_8_chart" class="card-rounded-bottom" style="height: 150px"></div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 8-->
        </div>
    </div>

    @push('footer')
    {{-- <script>
        "use strict";

// Class definition
var KTWidgets = function() {



    var _initStatsWidget8 = function() {
        var element = document.getElementById("kt_stats_widget_8_chart");

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Net Profit',
                data: [30, 45, 32, 70, 40]
            }],
            chart: {
                type: 'area',
                height: 150,
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
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [KTApp.getSettings()['colors']['theme']['base']['danger']]
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false,
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                },
                crosshairs: {
                    show: false,
                    position: 'front',
                    stroke: {
                        color: KTApp.getSettings()['colors']['gray']['gray-300'],
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
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false,
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
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
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function(val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
            markers: {
                colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
                strokeColor: [KTApp.getSettings()['colors']['theme']['base']['danger']],
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

    

    // Public methods
    return {
                init: function() {
                
                    _initStatsWidget8();
                
                }
            }
        }();

        // Webpack support
        if (typeof module !== 'undefined') {
            module.exports = KTWidgets;
        }

        jQuery(document).ready(function() {
            KTWidgets.init();
        });
    </script> --}}
@endpush
</div>
