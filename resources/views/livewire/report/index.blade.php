<div>
    <div class="container mt-n15">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="fa fa-chart-bar text-success"></i>
                    </span>
                    <h3 class="card-label">Selecciona el tipo de reporte de tu interes</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="my-10 d-flex justify-content-center">
                    
                    <div class="col-md-6 col-xxl-3 text-center border-right-0 border-right-md border-bottom border-bottom-xxl-0">
                      
                        <img class="img-fluid" src="{{ asset('assets/media/ilustrations/users.png') }}" alt="">
                            
                        <span class="font-size-h1 d-block font-weight-boldest text-dark-75 py-2">Usuario</span>
                        <p class="mb-15 d-flex flex-column">
                            <span>Prospectos registrados</span>
                            <span>Clientes registrados</span>
                            <span>Ventas</span>
                            <span>Cotizaciones registradas</span>
                            <span>Facturas registradas</span>
                            <span>Pagos registrados</span>
                            <span>Gastos registrados</span>
                        </p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('report.user') }}" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Generar rango de fechas</a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xxl-3 text-center border-right-0 border-right-md border-bottom border-bottom-xxl-0">
                      
                        <img class="img-fluid" src="{{ asset('assets/media/ilustrations/clients.png') }}" alt="">
                            
                        <span class="font-size-h1 d-block font-weight-boldest text-dark-75 py-2">Cliente</span>
                        <p class="mb-15 d-flex flex-column">
                            <span>Servicios registrados</span>
                            <span>Proyectos registrados</span>
                            <span>Ingresos</span>
                            <span>Egresos</span>
                            <span>Facturas registradas</span>
                            <span>Cotizaciones registrados</span>
                        </p>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Generar rango de fechas</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>

</div>
