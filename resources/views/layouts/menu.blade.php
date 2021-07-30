<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-section">
                <h4 class="menu-text">Dashboard</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
            
            <li class="menu-item {{ active('dashboard.index') }}" >
                <a href="{{ route('dashboard.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fab fa-buffer"></i>
                    <span class="menu-text">General</span>
                </a>
            </li>
            <li class="menu-item {{ active('google.analytics') }}" >
                <a href="{{ route('google.analytics') }}" class="menu-link">
                    <i class="menu-icon text-dark fas fa-signal"></i>
                    <span class="menu-text">Google Analytics</span>
                </a>
            </li>

            @canany(['prospectos', 'clientes', 'proveedores', 'tipo de servicio', 'servicios', 'proyectos', 'cotizaciones', 'calendario'])
                
                <div class="my-5"></div>

                <li class="menu-section">
                    <h4 class="menu-text">CRM</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

                @can('prospectos')
                <li class="menu-item {{ active('prospect.*') }}" >
                    <a href="{{ route('prospect.index') }}" class="menu-link">
                        <i class="menu-icon text-dark fa fa-users"></i>
                        <span class="menu-text">Prospectos</span>
                    </a>
                </li>
                @endcan
                @can('clientes')
                <li class="menu-item {{ active('client.*') }}" >
                    <a href="{{ route('client.index') }}" class="menu-link">
                        <i class="menu-icon text-dark fa fa-users"></i>
                        <span class="menu-text">Clientes</span>
                    </a>
                </li>
                @endcan
                @can('proveedores')
                <li class="menu-item {{ active('provider.*') }}" >
                    <a href="{{ route('provider.index') }}" class="menu-link">
                        <i class="menu-icon text-dark fas fa-truck"></i>
                        <span class="menu-text">Proveedores</span>
                    </a>
                </li>
                @endcan
                @can('tipo de servicio')
                <li class="menu-item {{ active('service-type.*') }}">
                    <a href="{{ route('service-type.index') }}" class="menu-link">
                        <i class="menu-icon text-dark fa fa-star"></i>
                        <span class="menu-text">Tipos de servicios</span>
                    </a>
                </li>
                @endcan
                @can('servicios')
                <li class="menu-item {{ active('service.*') }}">
                    <a href="{{ route('service.index') }}" class="menu-link">
                        <i class="menu-icon text-dark fa fa-star"></i>
                        <span class="menu-text">Servicios</span>
                    </a>
                </li>
                @endcan
                @can('proyectos')
                <li class="menu-item {{ active('project.*') }}">
                    <a href="{{ route('project.index') }}" class="menu-link">
                        <i class="menu-icon text-dark fas fa-rocket"></i>
                        <span class="menu-text">Proyetos</span>
                    </a>
                </li>
                @endcan
                @can('servicios')
                <li class="menu-item {{ active('quotation.*') }}">
                    <a href="{{ route('quotation.index') }}" class="menu-link">
                        <i class="menu-icon text-dark fa fa-sticky-note"></i>
                        <span class="menu-text">Cotizaciones</span>
                    </a>
                </li>
                @endcan
                <li class="menu-item">
                    <a target="_blank" href="https://calendar.google.com/" class="menu-link">
                        <i class="menu-icon text-dark far fa-calendar-alt"></i>
                        <span class="menu-text">Calendario</span>
                    </a>
                </li>
                
            
            @endcanany

            @canany(['facturas', 'pagos'. 'gastos'])
                <div class="my-5"></div>

                <li class="menu-section">
                    <h4 class="menu-text">Cobranza</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                
                @can('facturas')
                <li class="menu-item {{ active('invoice.*') }}">
                    <a href="{{ route('invoice.index') }}" class="menu-link">
                        <i class="menu-icon text-dark fas fa-file-pdf"></i>
                        <span class="menu-text">Facturas</span>
                    </a>
                </li>
                @endcan
                @can('pagos')
                <li class="menu-item {{ active('payment.*') }}">
                    <a href="{{ route('payment.index') }}" class="menu-link">
                        <i class="menu-icon text-dark fa fa-credit-card"></i>
                        <span class="menu-text">Pagos</span>
                    </a>
                </li>
                @endcan
                @can('gastos')
                <li class="menu-item {{ active('expense.*') }}">
                    <a href="{{ route('expense.index') }}" class="menu-link">
                        <i class="menu-icon text-dark fa fa-calculator"></i>
                        <span class="menu-text">Gastos</span>
                    </a>
                </li>
                @endcan
            @endcanany

            <div class="my-5"></div>
            <li class="menu-section">
                <h4 class="menu-text">Ajustes</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>

            @can('usuarios')
            <li class="menu-item {{ active('user.*') }}">
                <a href="{{ route('user.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fa fa-users"></i>
                    <span class="menu-text">Usuarios</span>
                </a>
            </li>
            @endcan
            @can('reportes')
            <li class="menu-item {{ active('report.*') }}">
                <a href="{{ route('report.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fa fa-chart-bar"></i>
                    <span class="menu-text">Reportes</span>
                </a>
            </li>
            @endcan
            @can('ajustes')
            <li class="menu-item {{ active('setting.*') }}">
                <a href="{{ route('setting.welcome.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fa fa-cog"></i>
                    <span class="menu-text">Configuraciones</span>
                </a>
            </li>
            @endcan
            @can('log')
            <li class="menu-item {{ active('log.*') }}">
                <a href="{{ route('log.index') }}" class="menu-link">
                    <i class="menu-icon text-dark far fa-eye"></i>
                    <span class="menu-text">Logs</span>
                </a>
            </li>
            @endcan
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->