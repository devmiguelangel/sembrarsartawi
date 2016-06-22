@extends('layout')

@section('header')
@include('partials.header-home')
@endsection

@section('menu-main')
@include('partials.menu-main')
@endsection

@section('menu-header')

@if($flag == 1) 
 @var $title = 'General Desgravamen' 
 @var $sub_title = 'Listado de Pólizas Desgravamen' 
@else 
 @var $title = 'Polizas Emitidas Desgravamen' 
 @var $sub_title = 'Listado de Pólizas Emitidas Desgravamen' 
@endif

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Desgravamen</span></h4>

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
                            <a href="{{ route('report.report_cotizacion',[ 'id_comp' => $id_comp ]) }}">Solicitudes Desgravamen </a>
                        </li>
                        @if($flag == 1) 
                            <li class="active">
                        @else
                            <li>
                        @endif
                            <a href="{{ route('report.report_general',[ 'id_comp' => $id_comp ]) }}">General Desgravamen </a>
                        </li>
                        @if($flag == 2) 
                            <li class="active">
                        @else
                            <li>
                        @endif
                            <a href="{{ route('report.report_general_emitido',[ 'id_comp' => $id_comp ]) }}">P&oacute;lizas Emitidas Desgravamen </a>
                        </li>
                    </ul>
                    <div class="tab-content">  
                        <div class="col-xs-12 col-md-12">
                            <form class="form-horizontal form-validate-jquery" action="" id="form_search_general">
                            @if($flag == 1) 
                                {!! Form::open(['route' => ['report.report_general_result','id_comp'=>$id_comp], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            @else
                                {!! Form::open(['route' => ['report.report_general_result_emitido','id_comp'=>$id_comp], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            @endif
                                <div class="panel-body ">
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Póliza: </label>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Nro</span>
                                                    <input name="numero_poliza" value="{{ $valueForm['numero_poliza'] }}" type="text" class="form-control ui-wizard-content" placeholder="Nro. Póliza">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Cliente: </label>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                                    <input name="cliente" value="{{ $valueForm['cliente'] }}" type="text" class="form-control ui-wizard-content" placeholder="Cliente">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Agencia: </label>
                                            <div class="col-lg-8">
                                                {!! Form::select('agencia', 
                                                        (['0' => 'Seleccione'] + $agencies), 
                                                        $valueForm['agencia'], 
                                                    ['class' => 'select-search']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">CI: </label>
                                            <div class="col-lg-8">
                                                <input name="ci" value="{{ $valueForm['ci'] }}" type="text" class="form-control ui-wizard-content" placeholder="CI">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Usuario: </label>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                                    {!! Form::select('usuario', 
                                                        (['0' => 'Seleccione'] + $users), 
                                                        $valueForm['usuario'], 
                                                    ['class' => 'select-search']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Extensión: </label>
                                            <div class="col-lg-8">
                                                {!! Form::select('extension', 
                                                        (['0' => 'Seleccione'] + $extencion), 
                                                        $valueForm['extension'], 
                                                    ['class' => 'select-search']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Sucursal: </label>
                                            <div class="col-lg-8">
                                                {!! Form::select('sucursal', 
                                                        (['0' => 'Seleccione'] + $cities), 
                                                        $valueForm['sucursal'], 
                                                    ['class' => 'select-search']) !!}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group col-md-8">
                                            <label class="control-label col-lg-1">Fecha: </label>
                                            <label class="control-label col-lg-1">Desde: </label>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                    <input name="fecha_ini" type="text" value="{{ $valueForm['fecha_ini'] }}" class="form-control pickadate-cobodate" placeholder="Desde">
                                                </div>
                                            </div>
                                            <label class="control-label col-lg-1">Hasta: </label>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                    <input name="fecha_fin" type="text" value="{{ $valueForm['fecha_fin'] }}" class="form-control pickadate-cobodate" placeholder="Hasta">
                                                </div>
                                            </div>
                                        </div>
                                        @if($flag == 2)
                                        <div class="form-group col-md-4">
                                            <label class="radio-inline radio-right">Anulados: </label>
                                            <label class="radio-inline radio-left">
                                                <input type="radio" name="anulados" value="1" class="styled" @if($valueForm['anulados']==1) checked @endif>
                                                Si
                                            </label>
                                            <label class="radio-inline radio-left">
                                                <input type="radio" name="anulados" value="2" class="styled" @if($valueForm['anulados']==2) checked @endif>
                                                No
                                            </label>
                                            <label class="radio-inline radio-left">
                                                <input type="radio" name="anulados" value="3" class="styled" @if($valueForm['anulados']==3) checked @endif>
                                                Todos
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                    <input type="hidden" id="xls_download" name="xls_download" value="0">
                                    <input type="hidden" id="flag" name="flag" value="{{ $flag }}">
                                </div>
                                @if($flag == 1)
                                <div class="col-md-12">
                                    <div class="panel panel-flat">
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="checkbox-inline checkbox-right">
                                                        <strong>Estado:</strong> &nbsp;
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" class="styled" name="pendiente" value="1" id="pendiente" @if($valueForm['pendiente']==1) checked @endif>     
                                                               Pendiente
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" class="styled" name="subsanado" value="1" id="subsanado" @if($valueForm['subsanado']==1) checked @endif>
                                                               Subsanado/Pendiente
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" class="styled" name="observado" value="1" id="observado" @if($valueForm['observado']==1) checked @endif>
                                                               Observado
                                                    </label>
                                                </div>
                                                <!-- Solo generales (estado facultativo)-->
                                                @if($flag == 1)
                                                    <div class="form-group">
                                                        @foreach($rp_state as $state)
                                                            <label class="checkbox-inline checkbox-left">
                                                                <input type="checkbox" class="styled" name="{{ $state->states->slug }}" value="1" id="{{ $state->states->slug }}" @if($valueForm[$state->states->slug]==1) checked @endif>     
                                                                       {{ $state->states->state }}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <hr />
                                                <div class="form-group">
                                                    <label class="checkbox-inline checkbox-right">
                                                        <strong>Aprobado:</strong> &nbsp;
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" value="1" class="styled" name="freecover" id="freecover" @if($valueForm['freecover']==1) checked @endif>
                                                               Free Cover
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" value="1" class="styled" name="no_freecover" id="no_freecover" @if($valueForm['no_freecover']==1) checked @endif>
                                                               No Free Cover
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" value=1"" class="styled" name="extraprima" id="extraprima" @if($valueForm['extraprima']==1) checked @endif>
                                                               Extraprima
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" value="1" class="styled" name="no_extraprima" id="no_extraprima" @if($valueForm['no_extraprima']==1) checked @endif>
                                                               No Extraprima
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" value="1" class="styled" name="emitido" id="emitido" @if($valueForm['emitido']==1) checked @endif>
                                                               Emitido
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" value="1" class="styled" name="no_emitido" id="no_emitido" @if($valueForm['no_emitido']==1) checked @endif>
                                                               No Emitido
                                                    </label>
                                                </div>
                                                <hr />
                                                <div class="form-group">
                                                    <label class="checkbox-inline checkbox-right">
                                                        <strong>Rechazado/Anulado:</strong> &nbsp;
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" class="styled" value="1" name="rechazado" id="rechazado" @if($valueForm['rechazado']==1) checked @endif>
                                                               Rechazado
                                                    </label>
                                                    <label class="checkbox-inline checkbox-left">
                                                        <input type="checkbox" class="styled" value="1" name="anulado" id="anulado" @if($valueForm['anulado']==1) checked @endif>
                                                               Anulado
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-xs-12 col-md-12">
                                    <div class="text-right">
                                        @if($flag == 1) 
                                        <a href="{{ route('report.report_general',['id_comp'=>$id_comp]) }}" class="btn btn-default" title="Cancelar">Cancelar <i class="icon-cross2 position-right"></i></a>
                                        @else 
                                        <a href="{{ route('report.report_general_emitido',['id_comp'=>$id_comp]) }}" class="btn btn-default" title="Cancelar">Cancelar <i class="icon-cross2 position-right"></i></a>
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
                                    <table class="table datatable-fixed-left_order_false table-striped" width="100%">
                                        <thead>
                                            <tr style="background-color: #337ab7" class="text-white">
                                                <th>Número de Póliza</th>
                                                <th>Cobertura</th>
                                                <th>Cliente</th>
                                                <th>CI</th>
                                                <th>Género</th>
                                                <th>Edad</th>
                                                <th>Ciudad</th>
                                                <th>Tel&eacute;fono</th>
                                                <th>Monto Solicitado - Moneda</th>
                                                <th>Saldo Deudor</th>
                                                <th>Total Monto Acumulado</th>
                                                <th>Plazo del Credito - Tipo del Plazo</th>
                                                <th>Estatura (cm)</th>
                                                <th>Peso (kg)</th>
                                                <th>Participación</th>
                                                <th>Titular</th>
                                                <th>Creado por</th>
                                                <th>Sucursal / Regional</th>
                                                <th>Fecha de Ingreso</th>
                                                <th>Certificado Emitido</th>
                                                <th>Fecha Emisión</th>
                                                <th>Estado Compañia</th>
                                                <th>Facultativo Observación</th>
                                                <th>Motivo Estado Compañia</th>
                                                <th>Porcentaje Extraprima</th>
                                                <th>Fecha Respuesta Final Compañia</th>
                                                <th>Días en Proceso</th>
                                                <th>Duracion Total del Caso</th>

                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @var $sum = 1
                                            @foreach($result as $entities)

                                            <tr>
                                                <td>{{ $entities->policy_number }}</td>
                                                <td>{{ $entities->name_coverage }}</td>
                                                <td>{{ $entities->client }}</td>
                                                <td>{{ $entities->ci_client }}</td>
                                                <td>{{ $entities->gender == 'M'?'Masculino':'Femenino' }}</td>
                                                <td>{{ $entities->age }}</td>
                                                <td>{{ str_replace('_', ' ', $entities->place_residence) }}</td>
                                                <td>{{ $entities->phone_number_home }}</td>
                                                <td>{{ $entities->amount_currency }}</td>
                                                <td>{{ $entities->balance }}</td>
                                                <td>{{ $entities->cumulus }}</td>
                                                <td>{{ $entities->plazo }}</td>
                                                <td>{{ $entities->estatura }}</td>
                                                <td>{{ $entities->peso }}</td>
                                                <td>{{ $entities->participacion }}</td>
                                                <td>{{ $entities->titular }}</td>
                                                <td>{{ $entities->creado_por }}</td>
                                                <td>{{ $entities->sucursal_regional }}</td>
                                                <td>{{ $entities->fecha_de_ingreso }}</td>
                                                <td>{{ $entities->certificado_emitido }}</td>
                                                <td>{{ $entities->fecha_emision }}</td>
                                                <td>{{ $entities->estado_compania }}</td>
                                                <td style="width: 100px;">{{ $entities->observation_facultative }}</td>
                                                <td>{{ $entities->motivo_estado_compania }}</td>
                                                <td>{{ $entities->porcentaje_extraprima }}</td>
                                                <td>{{ $entities->fecha_respuesta_final_compania }}</td>
                                                <td>{{ $entities->dias_en_proceso }}</td>
                                                <td>{{ $entities->duracion_total_del_caso }}</td>

                                                <td class="text-center">
                                                    <ul class="icons-list">
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
                                                </td>
                                            </tr>
                                            @var $sum++
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

<div class="row">
    <div class="col-md-12">
        <!-- Horizontal form -->
        <div class="panel panel-flat border-top-primary">
            <div class="panel-heading divhr">
                <h6 class="form-wizard-title2 text-semibold">
                    <span class="col-md-12">
                        <span class="form-wizard-count">R</span>
                        {{ $title }}
                        <small class="display-block">{{ $sub_title }}</small>
                    </span>
                </h6>
            </div>
            <div class="panel-body ">


            </div>

        </div>
        <!-- /horizotal form -->
    </div>
</div>



<!-- modal -->
@include('partials.modal_content')
<!-- /modal -->

@endsection
