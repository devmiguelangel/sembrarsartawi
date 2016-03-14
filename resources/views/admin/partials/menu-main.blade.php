<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">

        <ul class="navigation navigation-main navigation-accordion">
            @var $apo=false
            @var $aco=false
            @var $ata=false
            @var $aus=false
            @var $aoc=false
            @var $apr=false
            @var $acm=false
            @var $atc=false
            @var $aes=false
            @var $afo=false
            @var $ace=false
            @var $adg=false
            @var $ade=false
            @var $avi=false
            @if(auth()->user()->type->code=='ADT')
                @var $apo=true
                @var $aco=true
                @var $ata=true
                @var $aus=true
                @var $aoc=true
                @var $apr=true
                @var $acm=true
                @var $atc=true
                @var $aes=true
                @var $afo=true
                @var $ace=true
                @var $adg=true
                @var $ade=true
                @var $avi=true
            @else
                @foreach(auth()->user()->permissions as $user_permission)
                    @if($user_permission->slug == 'APL')
                        @var $apo=true
                    @endif
                    @if($user_permission->slug == 'ACV')
                        @var $aco=true
                    @endif
                    @if($user_permission->slug == 'ART')
                        @var $ata=true
                    @endif
                    @if($user_permission->slug == 'AOC')
                        @var $aoc=true
                    @endif
                    @if($user_permission->slug == 'AQS')
                        @var $apr=true
                    @endif
                    @if($user_permission->slug == 'AMC')
                        @var $acm=true
                    @endif
                    @if($user_permission->slug == 'AER')
                        @var $atc=true
                    @endif
                    @if($user_permission->slug == 'AST')
                        @var $aes=true
                    @endif
                    @if($user_permission->slug == 'AFR')
                        @var $afo=true
                    @endif
                    @if($user_permission->slug == 'AEM')
                        @var $ace=true
                    @endif
                    @if($user_permission->slug == 'ACA')
                        @var $adg=true
                    @endif
                    @if($user_permission->slug == 'AUS')
                        @var $aus=true
                    @endif
                    @if($user_permission->slug == 'ADE')
                        @var $ade=true
                    @endif
                    @if($user_permission->slug == 'AVI')
                        @var $avi=true
                    @endif
                @endforeach
            @endif


            <li class="navigation-header"><span>Inicio</span> <i class="icon-menu" title="Main pages"></i></li>
            @if($nav=='begin')
              @var $data='active'
            @else
              @var $data=''
            @endif
            <li class="{{$data}}">
                <a href="{{route('admin.home', ['nav'=>'begin'])}}">
                    <i class="icon-home4"></i><span>Inicio</span>
                </a>
            </li>
            <li class="navigation-header"><span>Modulos de Administración</span> <i class="icon-menu" title="Forms"></i></li>
            @if(auth()->user()->type->code=='ADT')
                @if($nav=='retailer')
                    @var $link_ar='active'
                    @var $link_acs=''
                    @var $link_pro=''
                    @var $link_spd=''
                @elseif($nav=='company' || $nav=='addprocom' || $nav=='addtoretailer' || $nav=='policynumber')
                    @var $link_acs='active'
                    @var $link_ar=''
                    @var $link_pro=''
                    @var $link_spd=''
                @elseif($nav=='product')
                    @var $link_pro='active'
                    @var $link_acs=''
                    @var $link_ar=''
                    @var $link_spd=''
                @elseif($nav=='subproduct')
                    @var $link_spd='active'
                    @var $link_acs=''
                    @var $link_ar=''
                    @var $link_pro=''
                @else
                    @var $link_acs=''
                    @var $link_ar=''
                    @var $link_pro=''
                    @var $link_spd=''
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
                <li class="{{$link_spd}}">
                    <a href="{{ route('admin.subproduct.list', ['nav'=>'subproduct', 'action'=>'list', 'id_retailer_product_select'=>0]) }}">
                        <i class="icon-stack2"></i> <span>Subproductos/Productos (Retailer)</span>
                    </a>
                </li>
            @endif

            @if($apo)
                @if($nav=='policy')
                    @if($action=='list' || $action=='new' || $action=='edit' || $action=='list_product_retailer')
                        @var $data_policy='active'
                    @endif
                @else
                    @var $data_policy=''
                @endif
                <li class="{{$data_policy}}">
                    <a href="{{route('admin.policy.list-product-retailer',['nav'=>'policy', 'action'=>'list_product_retailer'])}}" title='Administrar polizas'>
                        <i class="icon-folder"></i> Administrar polizas
                    </a>
                </li>
            @endif

            @if($aco)
                @if($nav=='coverage')
                    @if($action=='list' || $action=='new' || $action=='edit')
                        @var $data_cov='active'
                    @endif
                @else
                    @var $data_cov=''
                @endif
                <li class="{{$data_cov}}">
                    <a href="{{route('admin.cobertura.list',['nav'=>'coverage', 'action'=>'list'])}}" title='Administrar cobertura'>
                        <i class="icon-folder"></i> Administrar coberturas
                    </a>
                </li>
            @endif

            @if($ata)
                @if($nav=='rate')
                    @if($action=='list' || $action=='new' || $action=='edit')
                        @var $data_rate='active'
                    @endif
                @else
                    @var $data_rate=''
                @endif
                <li class="{{$data_rate}}">
                    <a href="{{route('admin.tasas.list',['nav'=>'rate', 'action'=>'list'])}}" title='Administrar tasas'>
                        <i class="icon-folder"></i> Administrar tasas
                    </a>
                </li>
            @endif

            @if($aoc)
                @if($nav=='adRetailerProductActivities')
                    @if($action=='list' || $action=='new' || $action=='edit')
                        @var $data_sel='active'
                    @endif
                @else
                    @var $data_sel=''
                @endif
                <li class="{{ $data_sel }}">
                    <a href="{{route('adRetailerProductActivities')}}" title='Administrar ocupación'>
                        <i class="icon-briefcase3"></i> Administrar ocupación
                    </a>
                </li>
            @endif

            @if($apr)
                @if($nav=='question')
                    @if($action=='list' || $action=='edit' || $action=='new')
                        @var $data_pp='active'
                    @endif
                @elseif($nav=='mcQuestionnaries')
                    @if($action=='list' || $action=='edit' || $action=='new')
                        @var $data_pp2='active'
                        @var $data_pp3=''
                    @endif
                @else
                    @var $data_pp=''
                    @var $data_pp2=''
                    @var $data_pp3=''
                @endif
                <li class="{{$data_pp}}">
                    <a href="{{route('admin.questions.list', ['nav'=>'question', 'action'=>'list'])}}"><i class="icon-clipboard3"></i> <span>Administrar preguntas (Cuestionario de Salud)</span></a>
                </li>
            @endif

            @if($acm)
                @if($nav=='mcCertificate')
                    @if($action=='list' || $action=='edit' || $action=='new' || $action=='asign')
                        @var $data_pp2='active'
                    @endif
                @else
                    @var $data_pp2=''
                @endif
                <li class="{{$data_pp2}}">
                    <a href="{{ route('mcCertificatesList') }}">
                        <i class="icon-paste"></i> <span>Administrar Certificado Médico</span>
                    </a>
                </li>
            @endif

            @if($atc)
                @if($nav=='exchange')
                    @var $data='active'
                @else
                    @var $data=''
                @endif
                <li class="{{$data}}">
                    <a href="{{ route('admin.exchange.list', ['nav'=>'exchange', 'action'=>'list']) }}">
                        <i class="icon-cash3"></i> <span>Tipo de Cambio</span>
                    </a>
                </li>
            @endif

            @if($aes)
                @if($nav=='state')
                    @if($action=='list' || $action=='new' || $action=='edit')
                        @var $data_state='active'
                    @endif
                @else
                    @var $data_state=''
                @endif
                <li class="{{$data_state}}">
                    <a href="{{route('admin.estados.list',['nav'=>'state', 'action'=>'list'])}}" title='Administrar estados'>
                        <i class="icon-folder"></i> Administrar estados
                    </a>
                </li>
            @endif

            @if($afo)
                @if($nav=='form')
                    @if($action=='list' || $action=='new' || $action=='edit' || $action=='list_product_retailer')
                        @var $data_form='active'
                    @endif
                @else
                    @var $data_form=''
                @endif
                <li class="{{$data_form}}">
                    <a href="{{route('admin.formulario.list-product-retailer',['nav'=>'form', 'action'=>'list_product_retailer'])}}" title='Administrar formularios'>
                        <i class="icon-folder"></i> Administrar formularios
                    </a>
                </li>
            @endif

            @if($ace)
                @if($nav=='email')
                    @var $data_em='active'
                @else
                    @var $data_em=''
                @endif
                <li class="{{$data_em}}">
                    <a href="{{route('admin.email.list-email-product-retailer', ['nav'=>'email', 'action'=>'list_epr'])}}">
                        <i class="icon-mail5"></i> <span>Correos Electronicos</span>
                    </a>
                </li>
            @endif

            @if($adg)
                @if($nav=='city')
                    @if($action=='list' || $action=='edit' || $action=='new' || $action=='list_city_retailer' || $action=='new_city_retailer')
                        @var $data_dpt='active'
                        @var $data_age=''
                    @endif
                @elseif($nav=='agency')
                    @if($action=='list' || $action=='edit' || $action=='new' || $action=='list_agency_retailer'|| $action=='new_agency_retailer')
                        @var $data_age='active'
                        @var $data_dpt=''
                    @endif
                @else
                    @var $data_dpt=''
                    @var $data_age=''
                @endif
                <li>
                    <a href="#"><i class="icon-city"></i> <span>Departamento/Agencias</span></a>
                    <ul>
                        <li class="{{$data_dpt}}">
                            <a href="{{route('admin.cities.list-city-retailer', ['nav'=>'city', 'action'=>'list_city_retailer'])}}">Departamentos</a>
                        </li>
                        <li class="{{$data_age}}">
                            <a href="{{route('admin.agencies.list-agency-retailer', ['nav'=>'agency', 'action'=>'list_agency_retailer'])}}">Agencias</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if($aus)
                @if($nav=='user')
                    @var $data='active'
                @else
                    @var $data=''
                @endif
                <li class="{{$data}}">
                    <a href="{{ route('admin.user.list', ['nav'=>'user', 'action'=>'list']) }}">
                        <i class="icon-users"></i> <span>Usuarios</span>
                    </a>
                </li>
            @endif


            <li class="navigation-header">
                <span>Productos</span> <i class="icon-menu" title="Forms"></i>
            </li>

            @var $sw_de=FALSE
            @var $sw_vi=FALSE
            @var $arr_prod=array()
            @foreach($array_data['products'] as $data_product)
                @var $arr_prod[]=$data_product->code
            @endforeach

            @if(count($main_menu)>0)
                @foreach($main_menu as $data)
                    
                    @if($ade)
                        @if($data->product=='de')
                            <li>
                                <a href="#"><i class="icon-puzzle4"></i> <span>Desgravamen</span></a>
                                @if($nav=='de')
                                    @if($action=='list_parameter' || $action=='edit_parameter' ||
                                        $action=='list_parameter_additional' || $action=='new_parameter_additional' ||
                                        $action=='edit_parameter_additional')
                                        @var $data_pp='active'
                                        @var $data_ap=''
                                        @var $data_ap2=''
                                        @var $data_ap3=''
                                        @var $data_content=''
                                    @endif
                                @elseif($nav=='addquestion')
                                    @if($action=='list' || $action=='new' || $action=='edit')
                                        @var $data_ap='active'
                                        @var $data_pp=''
                                        @var $data_ap2=''
                                        @var $data_ap3=''
                                        @var $data_content=''
                                    @endif
                                @elseif($nav=='adActivitiesList')
                                    @if($action=='list' || $action=='new'|| $action=='edit' || $action=='import')
                                        @var $data_ap3='active'
                                        @var $data_ap2=''
                                        @var $data_ap=''
                                        @var $data_pp=''
                                        @var $data_content=''
                                    @endif
                                @elseif($nav=='contentde')
                                    @if($action=='list' || $action=='edit' || $action=='new')
                                        @var $data_content='active'
                                        @var $data_pp=''
                                        @var $data_ap=''
                                        @var $data_ap2=''
                                        @var $data_ap3=''
                                    @endif
                                @else
                                    @var $data_pp=''
                                    @var $data_ap=''
                                    @var $data_ap2=''
                                    @var $data_ap3=''
                                    @var $data_content=''
                                @endif
                                <ul>
                                    <li class="{{$data_pp}}">
                                        <a href="{{route('admin.de.parameters.list-parameter', ['nav'=>'de', 'action'=>'list_parameter', 'id_retailer_product'=>$data->id_retailer_product])}}">Parametros del producto</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="{{$data_ap}}">
                                        <a href="{{route('admin.de.addquestion.list', ['nav'=>'addquestion', 'action'=>'list', 'id_retailer_product'=>$data->id_retailer_product])}}">Cuestionario de Salud</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="{{$data_content}}">
                                        <a href="{{route('admin.de.content.list', ['nav'=>'contentde', 'action'=>'list', 'id_retailer_products'=>$data->id_retailer_product])}}">Administrar contenido</a>
                                    </li>
                                </ul>
                            </li>

                        @endif
                    @endif

                    @if($avi)
                        @if($data->product=='vi' || $data->product=='vg')
                            <li>
                                <a href="#"><i class="icon-puzzle4"></i> <span>Vida Individual</span></a>
                                @if($nav=='vi')
                                    @if($action=='list' || $action=='edit' || $action='list_parameter_additional')
                                        @var $data_vpp='active'
                                        @var $data_cm=''
                                        @var $data_pl=''
                                        @var $data_contvi=''
                                        @var $data_modality=''
                                    @endif
                                @elseif($nav=='addquestionvi')
                                    @if($action=='list' || $action=='new' || $action=='edit')
                                        @var $data_cm='active'
                                        @var $data_vpp=''
                                        @var $data_pl=''
                                        @var $data_contvi=''
                                        @var $data_modality=''
                                    @endif
                                @elseif($nav=='listplansvi')
                                    @if($action=='list' || $action=='edit' || $action=='new')
                                        @var $data_pl='active'
                                        @var $data_cm=''
                                        @var $data_vpp=''
                                        @var $data_contvi=''
                                        @var $data_modality=''
                                    @endif
                                @elseif($nav=='contentvi')
                                    @if($action=='list' || $action=='edit' || $action=='new')
                                        @var $data_contvi='active'
                                        @var $data_cm=''
                                        @var $data_vpp=''
                                        @var $data_pl=''
                                        @var $data_modality=''
                                    @endif
                                @elseif($nav=='modality')
                                    @if($action=='list' || $action=='new' || $action=='edit')
                                        @var $data_modality='active'
                                        @var $data_cm=''
                                        @var $data_vpp=''
                                        @var $data_pl=''
                                        @var $data_contvi=''
                                    @endif
                                @else
                                    @var $data_cm=''
                                    @var $data_vpp=''
                                    @var $data_pl=''
                                    @var $data_contvi=''
                                    @var $data_modality=''
                                @endif
                                <ul>
                                    <li class="{{$data_vpp}}">
                                        <a href="{{route('admin.vi.parameters.list', ['nav'=>'vi', 'action'=>'list', 'id_retailer_product'=>$data->id_retailer_product])}}">Parametros del producto</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="{{$data_cm}}">
                                        <a href="{{route('admin.vi.addquestion.list', ['nav'=>'addquestionvi', 'action'=>'list', 'id_retailer_product'=>$data->id_retailer_product])}}">Cuestionario de Salud</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="{{$data_pl}}">
                                        <a href="{{route('admin.vi.planes.list', ['nav'=>'listplansvi', 'action'=>'list', 'id_retailer_product'=>$data->id_retailer_product])}}">Administrar planes</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="{{$data_contvi}}">
                                        <a href="{{route('admin.vi.content.list', ['nav'=>'contentvi', 'action'=>'list', 'id_retailer_product'=>$data->id_retailer_product])}}">Administrar contenido</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="{{$data_modality}}">
                                        <a href="{{route('admin.vi.modality.list', ['nav'=>'modality', 'action'=>'list', 'id_retailer_product'=>$data->id_retailer_product])}}">Administrar modalidad</a>
                                    </li>
                                </ul>
                            </li>

                        @endif
                    @endif
                @endforeach
            @else
                <div class="alert alert-warning alert-styled-left">
                    <span class="text-semibold"></span> No existe ningun producto registrado a un Retailer.
                </div>
            @endif

            
        </ul>
    </div>
</div>