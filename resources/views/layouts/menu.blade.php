<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            
            <li class="menu-item {{ active('dashboard.index') }}" >
                <a href="{{ route('dashboard.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fab fa-buffer"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="menu-item {{ active('user.show') }}" >
                <a href="{{ route('user.show', auth()->user()) }}" class="menu-link">
                    <i class="menu-icon text-dark fa fa-user"></i>
                    <span class="menu-text">Perfil</span>
                </a>
            </li>

            <div class="my-5"></div>

            <li class="menu-section">
                <h4 class="menu-text">CRM</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
            <li class="menu-item {{ active('prospect.*') }}" >
                <a href="{{ route('prospect.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fa fa-users"></i>
                    <span class="menu-text">Prospectos</span>
                </a>
            </li>
            <li class="menu-item {{ active('client.*') }}" >
                <a href="{{ route('client.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fa fa-users"></i>
                    <span class="menu-text">Clientes</span>
                </a>
            </li>
            <li class="menu-item {{ active('service.*') }}">
                <a href="{{ route('service.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fa fa-star"></i>
                    <span class="menu-text">Servicios</span>
                </a>
            </li>

            
            <div class="my-5"></div>

            <li class="menu-section">
                <h4 class="menu-text">Facturas y pagos</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
            <li class="menu-item {{ active('quotation.*') }}">
                <a href="{{ route('quotation.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fa fa-sticky-note"></i>
                    <span class="menu-text">Cotizaciones</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon text-dark fas fa-file-pdf"></i>
                    <span class="menu-text">Facturas</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon text-dark fa fa-credit-card"></i>
                    <span class="menu-text">Pagos</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon text-dark fa fa-calculator"></i>
                    <span class="menu-text">Gastos</span>
                </a>
            </li>

            <div class="my-5"></div>

            <li class="menu-item {{ active('user.*') }}">
                <a href="{{ route('user.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fa fa-users"></i>
                    <span class="menu-text">Usuarios</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon text-dark fa fa-chart-bar"></i>
                    <span class="menu-text">Informes</span>
                </a>
            </li>
            <li class="menu-item {{ active('setting.welcome.index') }}">
                <a href="{{ route('setting.welcome.index') }}" class="menu-link">
                    <i class="menu-icon text-dark fa fa-cog"></i>
                    <span class="menu-text">Configuraciones</span>
                </a>
            </li>
            
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->