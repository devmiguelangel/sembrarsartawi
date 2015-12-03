<div class="page-header-content">
    <div class="page-title">
        <h4>
            <i class="icon-arrow-left52 position-left"></i>
            @if($nav=='begin')
                <span class="text-semibold">Home</span> - Dashboard
            @elseif($nav=='user')
                @if($action=='list')
                    <span class="text-semibold">Lista</span> - Usuarios
                @elseif($action=='new')
                    <span class="text-semibold">Formulario</span> - Nuevo usuario
                @elseif($action=='edit')
                    <span class="text-semibold">Formulario</span> - Editar usuario
                @elseif($action=='changepass')
                    <span class="text-semibold">Formulario</span> - Cambiar contraseña
                @endif
            @endif
        </h4>
    </div>
    <!--
    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
        </div>
    </div>
    -->
</div>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        @if($nav=='begin')
            <li><a href="#"><i class="icon-home2 position-left"></i> Inicio</a></li>
            <li class="active">Dashboard</li>
        @elseif($nav=='user')
            @if($action=='list')
                <li>
                    <a href="{{ route('admin.home', ['nav'=>'begin']) }}">
                        <i class="icon-home2 position-left"></i> Inicio
                    </a>
                </li>
                <li class="active">Usuarios</li>
            @elseif($action=='new')
                <li>
                    <a href="{{ route('admin.home', ['nav'=>'begin']) }}">
                        <i class="icon-home2 position-left"></i>Inicio
                    </a>
                </li>
                <li><a href="{{ route('admin.user.list', ['nav'=>'user', 'action'=>'list']) }}">Listar usuarios</a></li>
                <li class="active">Usuario nuevo</li>
            @elseif($action=='edit')
                <li>
                    <a href="{{ route('admin.home', ['nav'=>'begin']) }}">
                        <i class="icon-home2 position-left"></i> Inicio
                    </a>
                </li>
                <li><a href="{{ route('admin.user.list', ['nav'=>'user', 'action'=>'list']) }}">Listar usuarios</a></li>
                <li class="active">Editar usuario</li>
            @elseif($action=='changepass')
                <li>
                    <a href="{{ route('admin.home', ['nav'=>'begin']) }}">
                        <i class="icon-home2 position-left"></i>Inicio
                    </a>
                </li>
                <li><a href="{{ route('admin.user.list', ['nav'=>'user', 'action'=>'list']) }}">Listar usuarios</a></li>
                <li class="active">Cambiar contraseña</li>
            @endif
        @endif
    </ul>
    <!--
    <ul class="breadcrumb-elements">
        <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-gear position-left"></i>
                Settings
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
            </ul>
        </li>
    </ul>
    -->
</div>