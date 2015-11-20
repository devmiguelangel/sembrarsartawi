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
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Seguro de Desgravamen</span></h4>

                <ul class="breadcrumb breadcrumb-caret position-right">
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Desgravamen</a></li>
                    <li class="active">Cotizar</li>
                </ul>
            </div>

        </div>
    </div>
@endsection

@section('content-wrapper')
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal form -->
            <div class="panel panel-flat border-top-primary">
                <div class="panel-heading divhr">
                    <h6 class="form-wizard-title2 text-semibold">
                                        <span class="col-md-11">
                                            <span class="form-wizard-count">2</span>
                                            Datos del Titular 1 o Titular 2
                                            <small class="display-block">Datos del Titular 1 o Titular 2</small>
                                        </span>
                                        <span class="col-md-1">
                                            <button style="float: left;" type="button" class="btn btn-rounded btn-default text-right" data-popup="tooltip" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                                                <i class="icon-question7"></i> Producto
                                            </button>
                                        </span>
                    </h6>
                </div>
                <br />
                <div class="col-xs-12">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::open(['route' => ['de.client.search', 'rp_id' => $rp_id, 'header_id' => $header_id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            {!! Form::hidden('header_id', $header_id) !!}
                            {!! Form::hidden('rp_id', encrypt($rp_id)) !!}
                            <div class="form-group has-success">
                                <label class="control-label col-lg-4 text-semibold" style="text-align: right;">Busqueda de datos:</label>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-search4"></i></span>
                                        {!! Form::text('dni', old('dni'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese Documento de identidad',
                                            'autocomplete' => 'off']) !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ session('client_search') }}</label>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    {!! Form::button('Buscar <i class="icon-search4"></i>', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('de.detail.create', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}">Agregar cliente <i class="icon-plus2 position-right"></i></a>
                        <a class="btn btn-primary" href="{{ route('de.result', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}">Continuar <i class="icon-arrow-right14 position-right"></i></a>
                    </div>
                </div>
                <table class="table datatable-basic">
                    @if($header->details->count() > 0)
                        <thead>
                        <tr>
                            <th>Titular</th>
                            <th>C.I.</th>
                            <th>Nombres y Apellidos</th>
                            <th>Fecha Nacimiento</th>
                            <th>Departamento</th>
                            <th>% Credito</th>
                            <th>Status</th>
                            <th class="text-center">Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($header->details as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="#">{{ $detail->client->dni }} {{ $detail->client->extension }}</a></td>
                                <td>{{ $detail->client->full_name }}</td>
                                <td>{{ dateToFormat($detail->client->birthdate) }}</td>
                                <td>{{ $detail->client->birth_place }}</td>
                                <td>{{ $detail->percentage_credit }} %</td>
                                <td><span class="label label-success">Active</span></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{ route('de.detail.edit', ['rp_id' => $rp_id, 'header_id' => $header_id, 'detail_id' => encode($detail->id)]) }}"><i class="icon-plus2"></i> Editar</a></li>
                                                <li><a href="#"><i class="icon-plus2"></i> Cuestionario de Salud</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection

