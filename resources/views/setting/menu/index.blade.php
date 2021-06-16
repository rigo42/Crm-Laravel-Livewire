<div class="col-xl-3">
    
    <ul class="navi navi-link-rounded navi-accent navi-hover navi-active nav flex-column mb-8 mb-lg-0" role="tablist">

        <li class="navi-item mb-2">
            <a class="navi-link {{ active('setting.welcome.index') }}" href="{{ route('setting.welcome.index') }}">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fab fa-buffer text-dark mr-2"></i> Bienvenido
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link" href="#">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fa fa-user text-dark mr-2"></i> Ajustes de cuenta
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link {{ active('setting.role.*') }}" href="{{ route('setting.role.index') }}">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fa fa-cog text-dark mr-2"></i> Roles
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link {{ active('setting.permission.*') }}"  href="{{ route('setting.permission.index') }}">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fa fa-cog text-dark mr-2"></i> Permisos
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link" href="#">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fa fa-university text-dark mr-2"></i> Información de empresa
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link" href="#">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fa fa-cog text-dark mr-2"></i> Preferencias
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link" href="#">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fa fa-bell text-dark mr-2"></i> Notificaciones
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link" href="#">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fa fa-credit-card text-dark mr-2"></i> Tipos de pago
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link" href="#">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fas fa-tag text-dark mr-2"></i> Categorias de gastos
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link {{ active('setting.category-service.*') }}"  href="{{ route('setting.category-service.index') }}">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fas fa-tag text-dark mr-2"></i> Categorias de servicios
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link" href="#">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fa fa-mail-bulk text-dark mr-2"></i> Configuración de correo
                </span>
            </a>
        </li>

        <li class="navi-item mb-2">
            <a class="navi-link" href="#">
                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">
                    <i class="fa fa-database text-dark mr-2"></i> Backup
                </span>
            </a>
        </li>
        
    </ul>
   
</div>