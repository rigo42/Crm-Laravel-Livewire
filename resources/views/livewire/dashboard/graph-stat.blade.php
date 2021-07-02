<div>
    <div class="row mb-5">
        <div class="col-xl-4">
            <!--begin::Stats Widget 8-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Gastos</a>
                            <span class="text-muted font-weight-bold mt-2">Año ({{ date('Y') }})</span>
                        </div>
                        <span class="label label-danger label-xl font-weight-boldest label-pill label-inline mr-2">${{ number_format($expensesTotal, 2, '.', ',') }}</span>
                    </div>
                    <div id="graphStatExpenses" class="card-rounded-bottom" style="height: 150px"></div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 8-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 8-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Pagos</a>
                            <span class="text-muted font-weight-bold mt-2">Año ({{ date('Y') }})</span>
                        </div>
                        <span class="label label-success label-xl font-weight-boldest label-pill label-inline mr-2">${{ number_format($paymentsTotal, 2, '.', ',') }}</span>
                    </div>
                    <div id="graphStatPayments" class="card-rounded-bottom" style="height: 150px"></div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 8-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 8-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Ingresos por factura</a>
                            <span class="text-muted font-weight-bold mt-2">Año ({{ date('Y') }})</span>
                        </div>
                        <span class="label label-dark label-xl font-weight-boldest label-pill label-inline mr-2">${{ number_format($invoicesTotal, 2, '.', ',') }}</span>
                    </div>
                    <div id="graphStatInvoices" class="card-rounded-bottom" style="height: 150px"></div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 8-->
        </div>
    </div>

    @push('footer')
    <script>
        graphExpense();
        graphPayment();
        graphInvoices();
        
        function graphExpense(){
            var element = document.getElementById("graphStatExpenses");

            var options = {
                series: [{
                    name: 'Gastos',
                    data: [
                        @foreach ($expenses as $expense)
                            {{ $expense }},
                        @endforeach
                    ]
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
                    colors: ['#F64E60']
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
                        show: false,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'font-family'
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
                            fontFamily: 'font-family'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        show: false,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'font-family'
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
                        fontFamily: 'font-family'
                    },
                    y: {
                        formatter: function(val) {
                            return '$' + (val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                        }
                    }
                },
                colors: ['#FFE2E5', '#F64E60'],
                markers: {
                    colors: ['#FFE2E5', '#F64E60'],
                    strokeColor: ['#F64E60'],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }

        function graphPayment(){
            var element = document.getElementById("graphStatPayments");

            var options = {
                series: [{
                    name: 'Pagos',
                    data: [
                        @foreach ($payments as $payment)
                            {{ $payment }},
                        @endforeach
                    ]
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
                    colors: ['#1BC5BD']
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
                        show: false,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'font-family'
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
                            fontFamily: 'font-family'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        show: false,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'font-family'
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
                        fontFamily: 'font-family'
                    },
                    y: {
                        formatter: function(val) {
                            return '$' + (val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                        }
                    }
                },
                colors: ['#C9F7F5', '#1BC5BD'],
                markers: {
                    colors: ['#C9F7F5', '#1BC5BD'],
                    strokeColor: ['#1BC5BD'],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }

        function graphInvoices(){
            var element = document.getElementById("graphStatInvoices");

            var options = {
                series: [{
                    name: 'Ingreso por facturas',
                    data: [
                        @foreach ($invoices as $invoice)
                            {{ $invoice }},
                        @endforeach
                    ]
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
                    colors: ['#0f1111']
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
                        show: false,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'font-family'
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
                            fontFamily: 'font-family'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        show: false,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'font-family'
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
                        fontFamily: 'font-family'
                    },
                    y: {
                        formatter: function(val) {
                            return '$' + (val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                        }
                    }
                },
                colors: ['#f2f2f2', '#0f1111'],
                markers: {
                    colors: ['#f2f2f2', '#0f1111'],
                    strokeColor: ['#0f1111'],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }
        
    </script>
@endpush
</div>
