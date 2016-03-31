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
                <h4><i class="icon-arrow-left52 position-left"></i> <span
                            class="text-semibold">Seguro de Automotores</span></h4>

                <ul class="breadcrumb breadcrumb-caret position-right">
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Automotores</a></li>
                    <li class="active">Cotizar</li>
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
                    <div class="steps-basic2 wizard">
                        <div class="steps">
                            <ul>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">1</span> Datos del Prestamo y Cliente
                                    </a>
                                </li>
                                <li class="current">
                                    <a href="#">
                                        <span class="current-info audible">current step: </span>
                                        <span class="number">2</span> Datos del Vehículo
                                    </a>
                                </li>
                                <li class="disabled last">
                                    <a href="#">
                                        <span class="number">3</span> Resultado Cotización
                                    </a>
                                </li>
                                <li class="disabled last">
                                    <a href="#">
                                        <span class="number">4</span> Emisión de la Póliza de Automotores
                                    </a>
                                </li>
                                <li class="disabled last">
                                    <a href="#">
                                        <span class="number">5</span> Impresión de la Póliza
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button style="float: right;" type="button" class="btn btn-rounded btn-default text-right"
                            title="Detalle de producto" data-placement="right" data-toggle="modal"
                            data-target="#modal_theme_primary">
                        <i class="icon-question7"></i> Producto
                    </button>
                </div>

                @if(session('error_header'))
                    <div class="alert bg-danger alert-styled-right">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span>
                        </button>
                        <span class="text-semibold">{{ session('error_header') }}</span>.
                    </div>
                @endif

                <div class="panel-body" ng-controller="DetailAuController">
                    <table class="table datatable-basic">
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Vehículo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Cero Km.</th>
                            <th>Año</th>
                            <th>Placa</th>
                            <th>Categoria</th>
                            <th>Valor Asegurado USD.</th>
                            <th class="text-center">Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="#">Minibus</a></td>
                            <td>TOYOTA</td>
                            <td>Corolla</td>
                            <td>NO</td>
                            <td>2015</td>
                            <td>FT545</td>
                            <td><span class="label label-success">B</span></td>
                            <td><strong>45.000 USD</strong></td>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="paso2_form.html"><i class="icon-pencil3"></i> Editar</a></li>
                                            <li><a href="paso2_form.html"><i class="icon-trash"></i> Eliminar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="#">Camioneta</a></td>
                            <td>NISSAN</td>
                            <td>Np300</td>
                            <td>SI</td>
                            <td>2016</td>
                            <td>LKJ345</td>
                            <td><span class="label label-success">B</span></td>
                            <td><strong>60.000 USD</strong></td>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="paso2_form.html"><i class="icon-pencil3"></i> Editar</a></li>
                                            <li><a href="paso2_form.html"><i class="icon-trash"></i> Eliminar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <hr/>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" ng-click="create($event)"
                                data-url="{{ route('au.vh.create', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}">
                            Agregar Vehículo <i
                                    class="icon-plus22 position-right"></i></button>

                        <button type="submit" class="btn btn-primary">Continuar <i
                                    class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection