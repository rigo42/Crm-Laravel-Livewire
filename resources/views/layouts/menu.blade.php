<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item {{ active('dashboard.index') }}" >
                <a href="{{ route('dashboard.index') }}" class="menu-link">
                    <i class="menu-icon fab fa-buffer"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="menu-item {{ active('client.*') }}" >
                <a href="{{ route('client.index') }}" class="menu-link">
                    <i class="menu-icon fa fa-users"></i>
                    <span class="menu-text">Clientes</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon fa fa-star"></i>
                    <span class="menu-text">Servicios</span>
                </a>
            </li>

            
            <div class="my-5"></div>

            
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon fa fa-sticky-note"></i>
                    <span class="menu-text">Presupuesto</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon fas fa-file-pdf"></i>
                    <span class="menu-text">Facturas</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon fa fa-credit-card"></i>
                    <span class="menu-text">Pagos</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon fa fa-calculator"></i>
                    <span class="menu-text">Gastos</span>
                </a>
            </li>

            <div class="my-5"></div>

            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon fa fa-users"></i>
                    <span class="menu-text">Usuarios</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon fa fa-chart-bar"></i>
                    <span class="menu-text">Informes</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon fa fa-cog"></i>
                    <span class="menu-text">Cconfiguraciones</span>
                </a>
            </li>
            
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->