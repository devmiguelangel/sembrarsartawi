@extends('layout')

@section('header')
@include('partials.header-home')
@endsection

@section('menu-main')
@include('partials.menu-main')
@endsection

@section('menu-header')

@if($flag == 1) 
 @var $title = 'General Multiriesgo' 
 @var $sub_title = 'Listado de Pólizas Multiriesgo' 
@else 
 @var $title = 'Polizas Emitidas Multiriesgo' 
 @var $sub_title = 'Listado de Pólizas Emitidas Multiriesgo' 
@endif

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <!--<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{ $title }}</span></h4>-->
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Multiriesgo</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="">Inicio</a></li>
                <li class="active">{{ $title }}</li>
            </ul>
        </div>

    </div>

</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat border-top-primary">
            <div class="panel-heading">
                <h6 class="form-wizard-title2 text-semibold">
                    <span class="col-md-12">
                        <span class="form-wizard-count">R</span>
                        Reportes
                        <small class="display-block">Listado </small>
                    </span>
                </h6>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                    <!--<ul class="nav nav-tabs nav-tabs-highlight nav-justified">-->
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li>
                            <a href="{{ route('report.td_report_cotizacion',[ 'id_comp' => $id_comp ]) }}">Solicitudes Multiriesgo </a>
                        </li>
                        @if($flag == 1) 
                            <li class="active">
                        @else
                            <li>
                        @endif
                            <a href="{{ route('report.td_report_general',[ 'id_comp' => $id_comp ]) }}">General Multiriesgo</a>
                        </li>
                        @if($flag == 2) 
                            <li class="active">
                        @else
                            <li>
                        @endif
                            <a href="{{ route('report.td_report_general_emitido',[ 'id_comp' => $id_comp ]) }}">P&oacute;lizas Emitidas Multiriesgo</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        
                <div class="col-xs-12 col-md-12">
                    <form class="form-horizontal form-validate-jquery" action="" id="form_search_general">
                    @if($flag == 1) 
                        {!! Form::open(['route' => ['report.td_report_general_result','id_comp'=>$id_comp], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    @else
                        {!! Form::open(['route' => ['report.td_report_general_result_emitido','id_comp'=>$id_comp], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    @endif
                    @include('report.partials.inputs-general_issue',
                    array(
                        'valueForm' => $valueForm,
                        'users' => $users,
                        'cities' => $cities,
                        'agencies' => $agencies,
                        'extencion' => $extencion,
                        'flag' => $flag,
                        'rp_state' => $rp_state,
                        'report' => 'au' 
                    ))
                        <div class="col-xs-12 col-md-12">
                            <div class="text-right">
                                @if($flag == 1) 
                                <a href="{{ route('report.td_report_general',['id_comp'=>$id_comp]) }}" class="btn btn-default" title="Cancelar">Cancelar <i class="icon-cross2 position-right"></i></a>
                                @else 
                                <a href="{{ route('report.td_report_general_emitido',['id_comp'=>$id_comp]) }}" class="btn btn-default" title="Cancelar">Cancelar <i class="icon-cross2 position-right"></i></a>
                                @endif 
                                
                                <button type="submit" class="btn btn-primary" id="buscar" onclick="$('#xls_download').val(0);">Buscar <i class="icon-search4 position-right"></i></button>
                            </div>
                            <p>&nbsp;</p>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-xs-12 col-md-12">  
                    @if (count($result)>0)
                        <div class="panel panel-flat">  
                            <div class="col-xs-12 col-md-12">
                                <div class="text-right">
                                    <br />
                                    <a onclick="$('#xls_download').val(1); $('#form_search_general').submit();">
                                        <img src="{{ asset('images/xls2.png') }}" alt="descargar" />
                                    </a>
                                </div>
                            </div>
                            <!--<table class="table datatable-fixed-left_order_false table-striped" width="100%">-->
                            <table class="table datatable-fixed-left_order_false" width="100%">
                                <thead>
                                    <tr style="background-color: #337ab7" class="text-white">
                                        <th>Nro. Emisión</th>
                                        <th>Cliente</th>
                                        <th>C.I.</th>
                                        <th>Genero</th>
                                        <!--<th>Plazo de Credito</th>-->
                                        <th>Forma de Pago</th>
                                        <th>Nro. Credito</th>
                                        <th>Tipo de Materia</th>
                                        <th>Descripcion</th>
                                        <th>Uso</th>
                                        <th>Ciudad</th>
                                        <th>Zona</th>
                                        <th>Localidad</th>
                                        <th>Direccion</th>
                                        <th>Valor Asegurado</th>
                                        <th>Taza</th>
                                        <th>Prima</th>
                                        <th>Moneda</th>
                                        <th>Usuario</th>
                                        <th>Sucursal Registro</th>
                                        <th>Agencia</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Anulado</th>
                                        <th>Anulado Por</th>
                                        <th>Fecha Anualción</th>
                                        <th>Facultativo Observación</th>
                                        <th>Estado Compañia</th>
                                        <th>Motivo Estado Compañia</th>
                                        <th>Estado Banco</th>
                                        <th>Porcentaje Extraprima</th>
                                        <th>Fecha Respuesta Final Compañia</th>
                                        <th>Duraci&oacute;n Total del Caso</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @var $num = 0
                                    @var $color = ''
                                    
                                    @foreach($result as $entities)
                                        
                                        @if($entities->nro_cotizacion == $num)
                                            @var $color = $color
                                        @else
                                            @if($color == 'A')
                                                @var $color = 'B'
                                            @else    
                                                @var $color = 'A'
                                            @endif
                                        @endif
                                        @if($color == 'A')
                                            <tr style="background-color: #eef9f8;">
                                        @else    
                                            <tr>
                                        @endif    
                                        <td>{{ $entities->nro_cotizacion }}</td>
                                        <td>{{ $entities->cliente }}</td>
                                        <td>{{ $entities->ci }}</td>
                                        <td>{{ $entities->genero }}</td>
                                        <!--<td>{{ $entities->plazo_de_credito }}</td>-->
                                        <td>{{ $entities->forma_de_pago=='AN'?'Anualizado':'Prima Total' }}</td>
                                        <td>{{ $entities->numero_credito }}</td>
                                        <td>{{ $entities->tipo_materia }}</td>
                                        <td>{{ $entities->descripcion }}</td>
                                        <td>{{ $entities->uso }}</td>
                                        <td>{{ $entities->ciudad }}</td>
                                        <td>{{ $entities->zona }}</td>
                                        <td>{{ $entities->localidad }}</td>
                                        <td>{{ $entities->direccion }}</td>
                                        <td>{{ $entities->valor_asegurado }} {{ $entities->moneda }}</td>
                                        <td>{{ $entities->taza }}</td>
                                        <td>{{ $entities->prima }}</td>
                                        <td>{{ $entities->moneda }}</td>
                                        <td>{{ $entities->usuario }}</td>
                                        <td>{{ $entities->sucursal_registro }}</td>
                                        <td>{{ $entities->agencia }}</td>
                                        <td>{{ $entities->fecha_de_ingreso }}</td>
                                        <td>{{ $entities->anulado == 0?'NO':'SI' }}</td>
                                        <td>{{ $entities->anulado_por }}</td>
                                        <td>{{ $entities->fecha_anulacion != ''?date('Y-m-d', strtotime($entities->fecha_anulacion)):'' }}</td>
                                        <td style="width: 100px;">{{ $entities->observation_facultative }}</td>
                                        <td>{{ $entities->estado_compania }}</td>
                                        <td>{{ $entities->motivo_estado_compania }}</td>
                                        <td>{{ $entities->estado_banco }}</td>
                                        <td>{{ $entities->porcentaje_extraprima }}</td>
                                        <td>{{ $entities->fecha_respuesta_final_compania }}</td>
                                        <td>{{ $entities->duracion_total_del_caso }}</td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            @if($flag==2)
                                                            <li>
                                                                <a href="{{route('create_modal_slip', ['id_retailer_product'=>$id_comp, 'id_header'=>encode($entities->id), 'text'=>'issuance', 'type'=>'IMPR'])}}"
                                                                   id="issuance" class="open_modal">
                                                                    <i class="icon-plus2"></i> Ver Certificado de Emision
                                                                </a>
                                                            </li>
                                                            @else
                                                            <li>
                                                                <a href="{{route('create_modal_slip', ['id_retailer_product'=>$id_comp, 'id_header'=>encode($entities->id), 'text'=>'slip', 'type'=>'IMPR'])}}"
                                                                   id="slip" class="open_modal">
                                                                    <i class="icon-plus2"></i> Ver Slip de Cotización
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{route('create_modal_slip', ['id_retailer_product'=>$id_comp, 'id_header'=>encode($entities->id), 'text'=>'issuance', 'type'=>'IMPR'])}}"
                                                                   id="issuance" class="open_modal">
                                                                    <i class="icon-plus2"></i> Ver Certificado de Emision
                                                                </a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </li>
                                                </ul>
                                        </td>
                                    </tr>
                                        
                                        @var $num = $entities->nro_cotizacion
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h1>No existen resultados.</h1>
                    @endif
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
@include('partials.modal_content')
<!-- /modal -->

@endsection
