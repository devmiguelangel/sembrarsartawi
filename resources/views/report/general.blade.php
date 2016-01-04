@extends('layout')

@section('header')
@include('partials.header-home')
@endsection

@section('menu-main')
@include('partials.menu-main')
@endsection

@section('menu-header')
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Reporte General</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="">Inicio</a></li>
                <li class="active">Reporte General</li>
            </ul>
        </div>

    </div>

</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal form -->
        <div class="panel panel-flat border-top-primary">
            <div class="panel-heading divhr">
                <h6 class="form-wizard-title2 text-semibold">
                    <span class="col-md-12">
                        <span class="form-wizard-count">R</span>
                        Reporte General
                        <small class="display-block">Listado de Pólizas Emitidas</small>
                    </span>
                </h6>
            </div>
            <div class="panel-body ">
                <div class="col-xs-12 col-md-12">
                    <form class="form-horizontal form-validate-jquery" action="" id="form_search_general">
                    {!! Form::open(['route' => ['report.report_general_result'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        <div class="panel-body ">
                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Nro. Póliza: </label>
                                    <div class="col-lg-8">
                                        <input name="numero_poliza" value="{{ $valueForm['numero_poliza'] }}" type="text" class="form-control ui-wizard-content" placeholder="Nro. Póliza">
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
                            <div class="col-xs-12 col-md-7">
                                <div class="form-group">
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
                            </div>
                            <input type="hidden" id="xls_download" name="xls_download" value="0">
                            <div class="col-xs-12 col-md-3">
                                <div class="text-right">
                                    <a href="{{ route('report.report_general') }}" class="btn btn-default" title="Cancelar">Cancelar <i class="icon-cross2 position-right"></i></a>
                                    <button type="submit" class="btn btn-primary" id="buscar" onclick="$('#xls_download').val(0);">Buscar <i class="icon-search4 position-right"></i></button>
                                </div>
                            </div>
                            
                        </div>
                        <hr />
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
                            <table class="table datatable-fixed-left table-striped" width="100%">
                                <thead>
                                    <tr style="background-color: #337ab7" class="text-white">
                                        <th>Nro. Póliza</th>
                                        <th>Producto</th>
                                        <th>Nro. de Operación</th>
                                        <th>Importe Solicitado</th>
                                        <th>Moneda</th>
                                        <th>Tiempo</th>
                                        <th>Tasa total</th>
                                        <th>Prima total</th>
                                        <th>Fecha de emisión</th>
                                        <th>Usuario</th>
                                        <th>Rol</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @var $sum = 1
                                    @foreach($result as $entities)
                                    
                                    <tr>
                                        <td>{{ $entities->policy_number }}</td>
                                        <td>{{ $entities->name }}</td>
                                        <td>{{ $entities->operation_number }}</td>
                                        <td>{{ $entities->amount_requested }}</td>
                                        <td>{{ $entities->currency }}</td>
                                        <td>{{ $entities->term }} {{ $entities->type_term == 'M'?'Meses':$entities->type_term == 'Y'?'Años':$entities->type_term == 'W'?'Semanas':$entities->type_term == 'D'?'DIas':'' }}</td>
                                        <td>{{ $entities->total_rate }}</td>
                                        <td>{{ $entities->total_premium }}</td>
                                        <td>{{ $entities->date_issue != ''?date('d-m-Y', strtotime($entities->date_issue)):'' }}</td>
                                        <td>{{ $entities->username }}</td>
                                        <td>{{ $entities->full_name }}</td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="#" onclick="cargaModal({{ $entities->id }},'{{ Session::token() }}', 'slip', 'POST', 'cotizacion')" data-toggle="modal" data-target="#modal_general">
                                                                    <i class="icon-plus2"></i> Ver Slip de Cotización
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="cargaModal({{ $entities->id }},'{{ Session::token() }}', 'slip', 'POST', 'emision')" data-toggle="modal" data-target="#modal_general">
                                                                    <i class="icon-plus2"></i> Ver Certificado de Desgravamen
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
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
        <!-- /horizotal form -->
    </div>
</div>

 

<!-- modal -->
@include('partials.modal')
<!-- /modal -->

@endsection
