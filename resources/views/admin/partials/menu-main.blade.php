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
            <li class="{{$data}}">
                <a href="{{route('admin.home', ['nav'=>'begin'])}}">
                    <i class="icon-home4"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="navigation-header"><span>Retailers,Productos y Compañías</span> <i class="icon-menu" title="Forms"></i></li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Compañías de Seguros</span></a>
                @if($nav=='company')
                    @if($action=='list_company' || $action=='new_company')
                        @var $data_lc='active'
                        @var $data_lp=''
                    @elseif($action=='list_policy')
                        @var $data_lp='active'
                        @var $data_lc=''
                    @endif
                @else
                    @var $data_lp=''
                    @var $data_lc=''
                @endif
                <ul>
                    <li class="{{$data_lc}}">
                        <a href="{{ route('admin.company.list', ['nav'=>'company', 'action'=>'list_company']) }}">Listar Compañías</a>
                    </li>
                    <li class="{{$data_lp}}">
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
                <a href="{{ route('admin.user.list', ['nav'=>'user', 'action'=>'list']) }}">
                    <i class="icon-stack2"></i> <span>Usuarios</span>
                </a>
            </li>
            <li class="navigation-header">
                <span>Cambio Monetario</span> <i class="icon-menu" title="Forms"></i>
            </li>
            @if($nav=='exchange')
                @var $data='active'
            @else
                @var $data=''
            @endif
            <li class="{{$data}}">
                <a href="{{ route('admin.exchange.list', ['nav'=>'exchange', 'action'=>'list']) }}">
                    <i class="icon-stack2"></i> <span>Tipo de Cambio</span>
                </a>
            </li>
            <li class="navigation-header">
                <span>Productos</span> <i class="icon-menu" title="Forms"></i>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Desgravamen</span></a>
                @if($nav=='de')
                    @if($action=='list_parameter' || $action=='edit_parameter' ||
                        $action=='list_parameter_additional' || $action=='new_parameter_additional' ||
                        $action=='edit_parameter_additional')
                        @var $data_pp='active'
                        @var $data_ap=''
                    @endif
                @elseif($nav=='addquestion')
                    @if($action=='list')
                        @var $data_ap='active'
                        @var $data_pp=''
                    @endif
                @else
                    @var $data_pp=''
                    @var $data_ap=''
                @endif
                <ul>
                    <li class="{{$data_pp}}">
                        <a href="{{route('admin.de.parameters.list-parameter', ['nav'=>'de', 'action'=>'list_parameter', 'id_retailer'=>auth()->user()->retailer->first()->id])}}">Parametros del producto</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#">Producto crediticio</a>
                    </li>
                </ul>
                <ul>
                    <li class="{{$data_ap}}">
                        <a href="{{route('admin.de.addquestion.list', ['nav'=>'addquestion', 'action'=>'list', 'id_retailer_product'=>1450961973])}}">Administrar preguntas</a>
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
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Vida Individual</span></a>
                <ul>
                    <li>
                        <a href="vid_parameter.html">Parametros del producto</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="vid_list_ap.html">Administrar preguntas</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="vid_edit_content.html">Administrar contenido</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="vid_managing_occupation.html">Administrar ocupación</a>
                    </li>
                </ul>
            </li>
            <li class="navigation-header">
                <span>kits de Página</span> <i class="icon-menu" title="Forms"></i>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Formas de pago</span></a>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Administrar correos</span></a>

            </li>
            @if($nav=='city')
                @if($action=='list' || $action=='edit' || $action=='new')
                    @var $data_dpt='active'
                    @var $data_age=''
                @endif
            @elseif($nav=='agency')
                @if($action=='list' || $action=='edit' || $action=='new')
                    @var $data_age='active'
                    @var $data_dpt=''
                @endif
            @else
                @var $data_dpt=''
                @var $data_age=''
            @endif
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Departamento/Agencias</span></a>
                <ul>
                    <li class="{{$data_dpt}}">
                        <a href="{{route('admin.cities.list', ['nav'=>'city', 'action'=>'list'])}}">Departamentos</a>
                    </li>
                    <li class="{{$data_age}}">
                        <a href="{{route('admin.agencies.list', ['nav'=>'agency', 'action'=>'list', 'id_retailer'=>auth()->user()->retailer->first()->id])}}">Agencias</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Administrar archivos</span></a>
            </li>
            @if($nav=='question')
                @if($action=='list' || $action=='edit' || $action=='new')
                    @var $data_pp='active'
                @endif
            @else
                @var $data_pp=''
            @endif
            <li class="{{$data_pp}}">
                <a href="{{route('admin.questions.list', ['nav'=>'question', 'action'=>'list'])}}"><i class="icon-stack2"></i> <span>Administrar preguntas</span></a>
            </li>
        </ul>
    </div>
</div>