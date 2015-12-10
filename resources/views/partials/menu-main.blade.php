<div class="navbar navbar-default" id="navbar-second">
    <div class="navbar-boxed">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
        </ul>
        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li><a href="#"><i class="icon-home2 position-left"></i> Inicio</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Descargar Formularios <span class="caret"></span></a>
                    <ul class="dropdown-menu width-200">
                        <li class="dropdown-header">Desgravamen</li>
                        <li class="active">
                            <a href="#"><i class="icon-align-center-horizontal"></i> Fixed width</a>
                        </li>
                        <li>
                            <a href="#"><i class="icon-flip-vertical3"></i> Sticky sidebar</a>
                        </li>
                    </ul>
                </li>
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
                                        <li><a href="{{ route('de.create', ['rp_id' => encode($retailerProduct->id)]) }}">Cotizar</a></li>
                                        <li class="dropdown-header highlight"><a href="#">Emitir</a></li>
                                        <li><a href="#">Facultativo</a></li>
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes  <span class="caret"></span></a>
                    <ul class="dropdown-menu width-200">
                        <li class="dropdown-submenu">
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
                        </li>
                        <li><a href="{{ route('report.report_general') }}">General</a></li>
                        <li><a href="#">Estadisticas</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-question7"></i> Preguntas frecuentes</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-mail5"></i> Contacto</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span><i class="icon-user"></i> {{ auth()->user()->full_name }}</span>
                        <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class="icon-user-plus"></i> Perfil</a></li>
                        <li><a href="#"><i class="icon-lock5"></i> Cambiar clave</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-phone"></i> Telefono Agencia</a></li>
                        <li><a href="{{ route('auth.logout') }}"><i class="icon-switch2"></i> Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>