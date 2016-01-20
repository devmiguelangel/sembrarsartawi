<div class="page-header-content">
    <div class="page-title">
        <h4><!--
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
                @elseif($action=='resetpass')
                    <span class="text-semibold">Formulario</span> - Resetear contraseña
                @endif
            @elseif($nav=='company')
                @if($action=='list_company')
                    <span class="text-semibold">Lista</span> - Compañías Aseguradoras
                @elseif($action=='new_company')
                    <span class="text-semibold">Formulario</span> - Nueva Compañía
                @endif
            @elseif($nav=='exchange')
                <span class="text-semibold">lista</span> - Tipo de cambio moneda
            @elseif($nav=='de')
                @if($action=='list_parameter')
                    <span class="text-semibold">lista</span> - Parametros
                @elseif($action=='edit_parameter')
                    <span class="text-semibold">Formulario</span> - Parametros
                @elseif($action=='list_parameter_additional')
                    <span class="text-semibold">Lista</span> - Parametros Adicionales
                @elseif($action=='new_parameter_additional' || $action=='edit_parameter_additional')
                    <span class="text-semibold">Formulario</span> - Parametros Adicionales
                @endif
            @elseif($nav=='question' || $nav=='city' || $nav=='agency' || $nav=='addquestion')
                @if($action=='list')
                    <span class="text-semibold">Listar Registros</span>
                @elseif($action=='edit' || $action=='new')
                    <span class="text-semibold">Formulario</span>
                @endif
            @endif
            -->
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
            @elseif($action=='resetpass')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li><a href="{{ route('admin.user.list', ['nav'=>'user', 'action'=>'list']) }}">Listar usuarios</a></li>
                <li class="active">Resetear contraseña</li>
            @endif
        @elseif($nav=='company')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Compañías</li>
            @elseif($action=='new' || $action=='edit')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li><a href="{{ route('admin.company.list', ['nav'=>'company', 'action'=>'list']) }}">Listar registros</a></li>
                @if($action=='new')
                    <li class="active">Nuevo registro</li>
                @elseif($action=='edit')
                    <li class="active">Editar registro</li>
                @endif
            @endif
        @elseif($nav=='exchange')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Tipo de cambio</li>
            @elseif($action=='new')
                <li>
                    <a href="{{ route('admin.home', ['nav'=>'begin']) }}">
                        <i class="icon-home2 position-left"></i>Inicio
                    </a>
                </li>
                <li><a href="{{ route('admin.exchange.list', ['nav'=>'exchange', 'action'=>'list']) }}">Listar registros</a></li>
                <li class="active">Tipo de cambio</li>
            @endif
        @elseif($nav=='de')
            @if($action=='list_parameter')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Parametros</li>
            @elseif($action=='edit_parameter')
                <li>
                    <a href="{{ route('admin.home', ['nav'=>'begin']) }}">
                        <i class="icon-home2 position-left"></i>Inicio
                    </a>
                </li>
                <li><a href="{{ route('admin.de.parameters.list-parameter', ['nav'=>'de', 'action'=>'list_parameter', 'id_retailer_product'=>$id_retailer_product]) }}">Listar registros</a></li>
                <li class="active">Formulario</li>
            @elseif($action=='list_parameter_additional')
                <li>
                    <a href="{{ route('admin.home', ['nav'=>'begin']) }}">
                        <i class="icon-home2 position-left"></i>Inicio
                    </a>
                </li>
                <li><a href="{{ route('admin.de.parameters.list-parameter', ['nav'=>'de', 'action'=>'list_parameter', 'id_retailer_product'=>$id_retailer_product]) }}">Listar registros</a></li>
                <li class="active">parametros adicionales</li>
            @elseif($action=='new_parameter_additional' || $action=='edit_parameter_additional')
                <li>
                    <a href="{{ route('admin.home', ['nav'=>'begin']) }}">
                        <i class="icon-home2 position-left"></i>Inicio
                    </a>
                </li>
                <li><a href="{{route('admin.de.parameters.list-parameter-additional', ['nav'=>'de', 'action'=>'list_parameter_additional', 'id_retailer_product'=>$id_retailer_product])}}">Listar parametros adicionales</a></li>
                @if($action=='new_parameter_additional')
                    <li class="active">Formulario nuevo registro</li>
                @elseif($action=='edit_parameter_additional')
                    <li class="active">Formulario editar registro</li>
                @endif
            @endif
        @elseif($nav=='question')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Preguntas</li>
            @elseif($action=='edit' || $action=='new')
                <li>
                    <a href="{{ route('admin.home', ['nav'=>'begin']) }}">
                        <i class="icon-home2 position-left"></i>Inicio
                    </a>
                </li>
                <li><a href="{{ route('admin.questions.list', ['nav'=>'question', 'action'=>'list']) }}">Listar preguntas</a></li>
                @if($action=='edit')
                    <li class="active">Editar pregunta</li>
                @elseif($action=='new')
                    <li class="active">Crear pregunta</li>
                @endif
            @endif
        @elseif($nav=='city')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Departamentos</li>
            @elseif($action=='edit' || $action=='new')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li><a href="{{ route('admin.cities.list', ['nav'=>'city', 'action'=>'list']) }}">Listar registros</a></li>
                @if($action=='edit')
                    <li class="active">Editar Registro</li>
                @elseif($action=='new')
                    <li class="active">Crear Registro</li>
                @endif
            @endif
        @elseif($nav=='agency')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Agencias</li>
            @elseif($action=='edit' || $action=='new')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li><a href="{{ route('admin.agencies.list', ['nav'=>'agency', 'action'=>'list', 'id_retailer'=>auth()->user()->retailer->first()->id]) }}">Listar registros</a></li>
                @if($action=='edit')
                    <li class="active">Editar</li>
                @elseif($action=='new')
                    <li class="active">Crear</li>
                @endif
            @endif
        @elseif($nav=='addquestion')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Listado de Preguntas</li>
            @elseif($action=='new')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li><a href="{{ route('admin.de.addquestion.list', ['nav'=>'addquestion', 'action'=>'list', 'id_retailer_product'=>$id_retailer_product]) }}">Listado de Preguntas</a></li>
                <li class="active">Agregar pregunta</li>
            @endif
        @elseif($nav=='retailer')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Retailer</li>
            @elseif($action=='new' || $action=='edit')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li><a href="{{ route('admin.retailer.list', ['nav'=>'retailer', 'action'=>'list']) }}">Listado registros</a></li>
                @if($action=='new')
                    <li class="active">Nuevo registro</li>
                @elseif($action=='edit')
                    <li class="active">Editar registro</li>
                @endif
            @endif
        @elseif($nav=='adActivitiesList')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Lista de Actividades</li>
            @elseif($action=='new' || $action=='edit')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li><a href="{{ route('adActivitiesList') }}">Lista de Actividades</a></li>
                @if($action=='new')
                    <li class="active">Nuevo registro</li>
                @elseif($action=='edit')
                    <li class="active">Editar registro</li>
                @endif
            @endif
        @elseif($nav=='adRetailerProductActivities')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Asignacion de Actividades</li>
            @elseif($action=='new' || $action=='edit')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li><a href="{{ route('adRetailerProductActivities') }}">Asignacion de Actividades</a></li>
                @if($action=='new')
                    <li class="active">Nuevo registro</li>
                @elseif($action=='edit')
                    <li class="active">Editar registro</li>
                @endif
            @endif
        @elseif($nav=='mcQuestionnaries')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Questionarios</li>
            @elseif($action=='new' || $action=='edit')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li><a href="{{ route('mcQuestionnariesList') }}">Questionarios</a></li>
                @if($action=='new')
                    <li class="active">Nuevo registro</li>
                @elseif($action=='edit')
                    <li class="active">Editar registro</li>
                @endif
            @endif
        @elseif($nav=='mcQuestions')
            @if($action=='list')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li class="active">Preguntas</li>
            @elseif($action=='new' || $action=='edit')
                <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
                <li><a href="{{ route('mcQuestionsList') }}">Preguntas</a></li>
                @if($action=='new')
                    <li class="active">Nuevo registro</li>
                @elseif($action=='edit')
                    <li class="active">Editar registro</li>
                @endif
            @endif
        @elseif($nav=='product')
            <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
            @if($action=='list')
                <li class="active">Productos</li>
            @elseif($action=='new' || $action=='edit')
                <li><a href="{{ route('admin.product.list', ['nav'=>'product', 'action'=>'list']) }}">Listado registros</a></li>
                @if($action=='new')
                    <li class="active">Nuevo registro</li>
                @elseif($action=='edit')
                    <li class="active">Editar registro</li>
                @endif
            @endif
        @elseif($nav=='addprocom')
            <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
            @if($action=='list')
                <li><a href="{{ route('admin.company.list', ['nav'=>'company', 'action'=>'list']) }}">Listado compañias</a></li>
                <li class="active">Productos agregados</li>
            @elseif($action=='new')
                <li><a href="{{ route('admin.company.list', ['nav'=>'company', 'action'=>'list']) }}">Listado compañias</a></li>
                <li><a href="{{ route('admin.addproductcompany.list', ['nav'=>'addprocom', 'action'=>'list', 'id_company'=>$id_company]) }}">Productos agregados a Compañia</a></li>
                <li class="active">Nuevo registro</li>
            @endif
        @elseif($nav=='addtoretailer')
            <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
            @if($action=='list')
                <li><a href="{{ route('admin.company.list', ['nav'=>'company', 'action'=>'list']) }}">Listado compañias</a></li>
                <li><a href="{{ route('admin.addproductcompany.list', ['nav'=>'addprocom', 'action'=>'list', 'id_company'=>$id_company]) }}">Productos agregados a Compañia</a></li>
                <li class="active">Listado Productos Retailer</li>
            @elseif($action=='new')
                <li><a href="{{ route('admin.company.list', ['nav'=>'company', 'action'=>'list']) }}">Listado compañias</a></li>
                <li><a href="{{ route('admin.addproductcompany.list', ['nav'=>'addprocom', 'action'=>'list', 'id_company'=>$id_company]) }}">Productos agregados a Compañia</a></li>
                <li><a href="{{ route('admin.addtoretailer.list', ['nav'=>'addtoretailer', 'action'=>'list', 'id_company'=>$id_company]) }}">Productos agregados a Retailer</a></li>
                <li class="active">Nuevo registro</li>
            @endif
        @elseif($nav=='policynumber')
            <li><a href="{{ route('admin.home', ['nav'=>'begin']) }}"><i class="icon-home2 position-left"></i>Inicio</a></li>
            @if($action=='list')
                <li><a href="{{ route('admin.company.list', ['nav'=>'company', 'action'=>'list']) }}">Listado compañias</a></li>
                <li><a href="{{ route('admin.addproductcompany.list', ['nav'=>'addprocom', 'action'=>'list', 'id_company'=>$id_company]) }}">Productos agregados a Compañia</a></li>
                <li><a href="{{ route('admin.addtoretailer.list', ['nav'=>'addtoretailer', 'action'=>'list', 'id_company'=>$id_company]) }}">Productos agregados a Retailer</a></li>
                <li class="active">Numero de Polizas</li>
            @elseif($action=='edit' || $action=='new')
                <li><a href="{{ route('admin.company.list', ['nav'=>'company', 'action'=>'list']) }}">Listado compañias</a></li>
                <li><a href="{{ route('admin.addproductcompany.list', ['nav'=>'addprocom', 'action'=>'list', 'id_company'=>$id_company]) }}">Productos agregados a Compañia</a></li>
                <li><a href="{{ route('admin.addtoretailer.list', ['nav'=>'addtoretailer', 'action'=>'list', 'id_company'=>$id_company]) }}">Productos agregados a Retailer</a></li>
                <li><a href="{{ route('admin.policy.list', ['nav'=>'policynumber', 'action'=>'list', 'id_company'=>$id_company, 'id_retailer_products'=>$id_retailer_products]) }}">Listado de pólizas</a></li>
                @if($action=='edit')
                    <li class="active">Editar registro</li>
                @elseif($action=='new')
                    <li class="active">Nuevo registro</li>
                @endif
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