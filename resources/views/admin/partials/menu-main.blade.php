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
            <li class="navigation-header"><span>Retailers/Productos/Compañías</span> <i class="icon-menu" title="Forms"></i></li>
            @if($nav=='retailer')
                @var $link_ar='active'
                @var $link_acs=''
                @var $link_pro=''
            @elseif($nav=='company' || $nav=='addprocom' || $nav=='addtoretailer' || $nav=='policynumber')
                @var $link_acs='active'
                @var $link_ar=''
                @var $link_pro=''
            @elseif($nav=='product')
                @var $link_pro='active'
                @var $link_acs=''
                @var $link_ar=''
            @else
                @var $link_acs=''
                @var $link_ar=''
                @var $link_pro=''
            @endif
            <li class="{{$link_ar}}">
                <a href="{{route('admin.retailer.list', ['nav'=>'retailer', 'action'=>'list'])}}">
                    <i class="icon-stack2"></i> <span>Retailer</span>
                </a>
            </li>
            <li class="{{$link_pro}}">
                <a href="{{ route('admin.product.list', ['nav'=>'product', 'action'=>'list']) }}">
                    <i class="icon-stack2"></i> <span>Productos</span>
                </a>
            </li>
            <li class="{{$link_acs}}">
                <a href="{{ route('admin.company.list', ['nav'=>'company', 'action'=>'list']) }}">
                    <i class="icon-stack2"></i> <span>Compañía de Seguros</span>
                </a>
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
                <span>Productos</span> <i class="icon-menu" title="Forms"></i>
            </li>

            @if(count($main_menu)>0)
                @foreach($main_menu as $data)
                    @if($data->product=='de')
                        <li>
                            <a href="#"><i class="icon-stack2"></i> <span>Desgravamen</span></a>
                            @if($nav=='de')
                                @if($action=='list_parameter' || $action=='edit_parameter' ||
                                    $action=='list_parameter_additional' || $action=='new_parameter_additional' ||
                                    $action=='edit_parameter_additional')
                                    @var $data_pp='active'
                                    @var $data_ap=''
                                    @var $data_ap2=''
                                    @var $data_ap3=''
                                @endif
                            @elseif($nav=='addquestion')
                                @if($action=='list' || $action=='new')
                                    @var $data_ap='active'
                                    @var $data_pp=''
                                    @var $data_ap2=''
                                    @var $data_ap3=''
                                @endif
                            @elseif($nav=='adRetailerProductActivities')
                                @if($action=='list' || $action=='new' || $action=='edit')
                                    @var $data_ap2='active'
                                    @var $data_ap3=''
                                    @var $data_ap=''
                                    @var $data_pp=''
                                @endif
                            @elseif($nav=='adActivitiesList')
                                @if($action=='list' || $action=='new'|| $action=='edit')
                                    @var $data_ap3='active'
                                    @var $data_ap2=''
                                    @var $data_ap=''
                                    @var $data_pp=''
                                @endif
                            @else
                                @var $data_pp=''
                                @var $data_ap=''
                                @var $data_ap2=''
                                @var $data_ap3=''
                            @endif
                            <ul>
                                <li class="{{$data_pp}}">
                                    <a href="{{route('admin.de.parameters.list-parameter', ['nav'=>'de', 'action'=>'list_parameter', 'id_retailer_product'=>$data->id_retailer_product])}}">Parametros del producto</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="{{$data_ap}}">
                                    <a href="{{route('admin.de.addquestion.list', ['nav'=>'addquestion', 'action'=>'list', 'id_retailer_product'=>$data->id_retailer_product])}}">Administrar preguntas</a>
                                </li>
                            </ul>
                            <!--
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
                            -->
                            <ul>
                                <li class="{{$data_ap2}}">
                                    <a href="{{route('adRetailerProductActivities')}}" title='Administrar ocupación'>Administrar ocupación</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="{{$data_ap3}}">
                                    <a href="{{route('adActivitiesList')}}" title='Administrar Actividades'>Administrar Actividades</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if($data->product=='vi')
                        <li>
                            <a href="#"><i class="icon-stack2"></i> <span>Vida Individual</span></a>
                            @if($nav=='vi')
                                @if($action=='list' || $action=='edit' || $action='list_parameter_additional')
                                    @var $data_vpp='active'
                                    @var $data_cm=''
                                @endif
                            @elseif($nav=='addquestionvi')
                                @if($action=='list' || $action=='new')
                                    @var $data_cm='active'
                                    @var $data_vpp=''
                                @endif
                            @else
                                @var $data_cm=''
                                @var $data_vpp=''
                            @endif
                            <ul>
                                <li class="{{$data_vpp}}">
                                    <a href="{{route('admin.vi.parameters.list', ['nav'=>'vi', 'action'=>'list', 'id_retailer_product'=>$data->id_retailer_product])}}">Parametros del producto</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="{{$data_cm}}">
                                    <a href="{{route('admin.vi.addquestion.list', ['nav'=>'addquestionvi', 'action'=>'list', 'id_retailer_product'=>$data->id_retailer_product])}}">Cuestionario Medico</a>
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
                    @endif
                @endforeach
            @else
                <div class="alert alert-warning alert-styled-left">
                    <span class="text-semibold">Warning!</span> No existe ningun producto, ingrese un nuevo producto.
                </div>
            @endif
            <li class="navigation-header">
                <span>kits de Página</span> <i class="icon-menu" title="Forms"></i>
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
            <!--
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Administrar correos</span></a>

            </li>
            -->
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
            <!--
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>Administrar archivos</span></a>
            </li>
            -->
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