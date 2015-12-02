<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">

            <!-- Main -->
            <li class="navigation-header"><span>Inicio</span> <i class="icon-menu" title="Main pages"></i></li>
            @if($nav=='begin')
              @var $data='active'
            @else
              @var $data=''
            @endif
            <li class="{{$data}}"><a href="index.html"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
            <li class="navigation-header"><span>Entidades y Compañias</span> <i class="icon-menu" title="Forms"></i></li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Compañías de Seguros</span></a>
                <ul>
                    <li>
                        <a href="companias_list.html">Listar Compañías</a>
                    </li>
                    <li>
                        <a href="policy_list.html">Administración de Pólizas</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Entidad Financiera</span></a>
                <ul>
                    <li>
                        <a href="entidades_list.html">Listar Registros</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Agegar compañías a Entidad Financiera</span></a>
                <ul>
                    <li>
                        <a href="agrega_cia_entidad_list.html">Listar Registros</a>
                    </li>
                </ul>
            </li>
            <li class="navigation-header">
                <span>Usuarios</span> <i class="icon-menu" title="Forms"></i>
            </li>
            @if($nav=='user')
                @var $data='active'
            @else
                @var $data=''
            @endif
            <li class="{{$data}}">
                <a href="{{ route('admin.user.list', ['nav'=>'user']) }}"><i class="icon-stack2"></i> <span>Usuarios</span></a>

            </li>
            <li class="navigation-header">
                <span>Cambio Monetario</span> <i class="icon-menu" title="Forms"></i>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Tipo de Cambio</span></a>
                <ul>
                    <li>
                        <a href="#">Listar Registros</a>
                    </li>
                </ul>
            </li>
            <li class="navigation-header">
                <span>Productos</span> <i class="icon-menu" title="Forms"></i>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Desgravamen</span></a>
                <ul>
                    <li>
                        <a href="#">Parametros del producto</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#">Producto crediticio</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#">Administrar preguntas</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#">Administrar contenido</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#">Administrar certificado médico</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#">Administrar ocupación</a>
                    </li>
                </ul>
            </li>
            <li class="navigation-header">
                <span>Forma de Pago</span> <i class="icon-menu" title="Forms"></i>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Formas de pago</span></a>
                <ul>
                    <li>
                        <a href="payment_methods_list.html">Listar Registros</a>
                    </li>
                </ul>
            </li>
            <li class="navigation-header">
                <span>Correos electronicos</span> <i class="icon-menu" title="Forms"></i>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Administrar correos</span></a>
                <ul>
                    <li>
                        <a href="email_list.html">Listar Registros</a>
                    </li>
                </ul>
            </li>
            <li class="navigation-header">
                <span>Sucursales</span> <i class="icon-menu" title="Forms"></i>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Departamento/Agencias</span></a>
                <ul>
                    <li>
                        <a href="#">Departamentos</a>
                    </li>
                    <li>
                        <a href="#">Agencias</a>
                    </li>
                </ul>
            </li>
            <li class="navigation-header">
                <span>Archivos</span> <i class="icon-menu" title="Forms"></i>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Administrar archivos</span></a>
                <ul>
                    <li>
                        <a href="#">Listar archivos</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>