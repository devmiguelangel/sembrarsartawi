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
                        <form class="form-horizontal" action="#">
                            <div class="form-group has-success">
                                <label class="control-label col-lg-4 text-semibold">Ingrese Documento de identidad:</label>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-search4"></i></span>
                                        <input type="text" class="form-control" placeholder="Ingrese Documento de identidad">
                                    </div>
                                    <span class="help-block">Busqueda de datos del Titular 1 o Titular2</span>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <button type="submit" class="btn btn-success">Buscar <i class="icon-search4"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('de.client.create', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}">Agregar cliente <i class="icon-plus2 position-right"></i></a>
                        <a class="btn btn-primary" href="form5.html">Continuar <i class="icon-arrow-right14 position-right"></i></a>
                    </div>
                </div>
                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th>Titular</th>
                        <th>C.I.</th>
                        <th>Ap. Paterno</th>
                        <th>Ap. Materno</th>
                        <th>Fecha Nacimiento</th>
                        <th>Departamento</th>
                        <th>% Credito</th>
                        <th>Status</th>
                        <th class="text-center">Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>T1</td>
                        <td><a href="#">6828185 lp</a></td>
                        <td>Mamani</td>
                        <td>Manrriquez</td>
                        <td>22 Jun 1982</td>
                        <td>La paz</td>
                        <td>100 %</td>
                        <td><span class="label label-success">Active</span></td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#"><i class="icon-plus2"></i> Registrar Benficiario</a></li>
                                        <li><a href="#"><i class="icon-plus2"></i> Registrar Saldo deudor</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>T2</td>
                        <td><a href="#">45645612 cb</a></td>
                        <td>Mendoza</td>
                        <td>Mamni</td>
                        <td>3 Oct 1981</td>
                        <td>Cochabamba</td>
                        <td>80 %</td>
                        <td><span class="label label-default">Inactive</span></td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#"><i class="icon-plus2"></i> Registrar Benficiario</a></li>
                                        <li><a href="#"><i class="icon-plus2"></i> Registrar Saldo deudor</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection

