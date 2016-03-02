<!--{{ Request::url() }}<br>
{{ Request::path() }}<br>
{{ Request::is('de/zw3q9d5n6qmjrgvrx8gmp1kx2/create') ? 'active' : '' }}<br>-->


<div class="navbar navbar-default" id="navbar-second">
    <div class="navbar-boxed">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
        </ul>
        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="icon-home2 position-left"></i> Inicio
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Descargar Formularios <span class="caret"></span></a>
                    <ul class="dropdown-menu width-200">
                      @foreach(auth()->user()->retailer->first()->retailerProducts as $retailerProduct)
                        @if($retailerProduct->type == 'MP')
                          <li class="dropdown-header">{{ $retailerProduct->companyProduct->product->name }}</li>
                          @foreach ($retailerProduct->forms as $form)
                            <li>
                              <a href="{{ asset($form->file) }}" target="_blank"><i class="icon-align-center-horizontal"></i> {{ $form->title }}</a>
                            </li>
                          @endforeach
                        @endif
                      @endforeach
                    </ul>
                </li>
                @if (auth()->user()->profile->first()->slug === 'SEP')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Productos <span class="caret"></span></a>
                        <ul class="dropdown-menu width-200">
                            @foreach(auth()->user()->retailer->first()->retailerProducts as $retailerProduct)
                                @if($retailerProduct->type == 'MP')
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-list-unordered"></i> {{ $retailerProduct->companyProduct->product->name }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if(isset($client))
                                                @var $client= encode($client->id)
                                            @else
                                                @var $client= ''
                                            @endif

                                            @if(isset($detail_id))
                                                @var $detail_id= $detail_id
                                            @else
                                                @var $detail_id= ''
                                            @endif

                                            @if(isset($header_id))
                                                @var $header_id= $header_id
                                            @else
                                                @var $header_id= ''
                                            @endif

                                            @if(isset($header))
                                                @var $header= encode($header->id)
                                            @else
                                                @var $header= ''
                                            @endif

                                            @if(isset($detail))
                                                @var $detail= encode($detail->id)
                                            @else
                                                @var $detail= ''
                                            @endif

                                            @if(isset($sp_id))
                                                @var $sp_id= $sp_id
                                            @else
                                                @var $sp_id= ''
                                            @endif

                                            <li class="{{
                                                        Request::is('de/'.encode($retailerProduct->id).'/create') ? 'active' :
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/list') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/client/create') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/client/create/'.$client.'') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/client/'.$detail_id.'/question/create') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/client/edit/'.$detail_id.'') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/result') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/edit') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/beneficiary/create/'.$detail.'') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/client/'.$detail_id.'/question/edit') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/issuance') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/vi/'.$sp_id.'') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header_id.'/vi/'.$sp_id.'/create') ? 'active':
                                                        Request::is('de/'.encode($retailerProduct->id).'/'.$header.'/balance/edit/'.$detail.'') ? 'active':
                                                        ''
                                                       }}
                                                       ">
                                                <a href="{{ route('de.create', ['rp_id' => encode($retailerProduct->id)]) }}">Cotizar</a>
                                            </li>
                                            <li class="{{ request()->route()->getName() === 'de.cancel.lists' ? 'active' : '' }}">
                                                <a href="{{ route('de.cancel.lists', ['rp_id' => encode($retailerProduct->id)]) }}">Anular Póliza</a>
                                            </li>
                                            <li class="{{ request()->route()->getName() === 'de.pre.approved.lists' ? 'active' : '' }}">
                                                <a href="{{ route('de.pre.approved.lists', ['rp_id' => encode($retailerProduct->id)]) }}">Solicitudes Preaprobadas</a>
                                            </li>
                                            <li class="{{ request()->route()->getName() === 'de.issue.lists' ? 'active' : '' }}">
                                                <a href="{{ route('de.issue.lists', ['rp_id' => encode($retailerProduct->id)]) }}">Emitir Solicitudes</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes  <span class="caret"></span></a>
                    <ul class="dropdown-menu width-200">
                        <!--<li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cotización</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Cotización personas</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Certificados</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Certificados personas</a></li>
                            </ul>
                        </li>-->
                        <li class="{{Request::is('report/general') ? 'active':''}}">
                            <a href="{{ route('report.report_general') }}">
                                General
                            </a>
                        </li>
                        <li class="{{Request::is('report/general_emitido') ? 'active':''}}">
                            <a href="{{ route('report.report_general_emitido') }}" title="Polizas Emitidas">
                                Polizas Emitidas
                            </a>
                        </li>
                        <li  class="{{Request::is('report/cotizacion') ? 'active':''}}">
                            <a href="{{ route('report.report_cotizacion') }}">
                                Solicitudes
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span><i class="icon-user"></i> {{ auth()->user()->full_name }}</span>
                        <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        {{--<li><a href="#"><i class="icon-user-plus"></i> Perfil</a></li>--}}
                        {{--<li><a href="#"><i class="icon-lock5"></i> Cambiar clave</a></li>--}}
                        <li class="divider"></li>
                        {{--<li><a href="#"><i class="icon-phone"></i> Telefono Agencia</a></li>--}}
                        <li><a href="{{ route('auth.logout') }}"><i class="icon-switch2"></i> Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>