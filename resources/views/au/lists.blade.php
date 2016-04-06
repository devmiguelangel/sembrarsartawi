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

                @if(session('success_header'))
                    <script>
                        $(function () {
                            messageAction('succes', "{{ session('success_header') }}");
                        });
                    </script>
                @endif

                <div class="panel-body" ng-controller="DetailAuController">
                    <table class="table datatable-basic2">
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
                        @foreach($header->details as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $detail->vehicleType->vehicle }}</td>
                                <td>{{ $detail->vehicleMake->make }}</td>
                                <td>{{ $detail->vehicleModel->model }}</td>
                                <td>{{ $detail->mileage_text }}</td>
                                <td>{{ $detail->year }}</td>
                                <td>{{ $detail->license_plate }}</td>
                                <td><span class="label label-success">{{ $detail->category->category_name }}</span></td>
                                <td>
                                    <strong>{{ number_format($detail->insured_value, 2) }} {{ $header->currency }}</strong>
                                </td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{ route('au.vh.edit', ['rp_id' => $rp_id, 'header_id' => $header_id, 'detail_id' => encode($detail->id)]) }}"
                                                       ng-click="edit($event)">
                                                        <i class="icon-pencil3"
                                                           ng-click="$event.stopPropagation(); $event.preventDefault()"></i>
                                                        Editar</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('au.vh.destroy', ['rp_id' => $rp_id, 'header_id' => $header_id, 'detail_id' => encode($detail->id)]) }}"
                                                       ng-click="delete($event)">
                                                        <i class="icon-trash"
                                                           ng-click="$event.stopPropagation(); $event.preventDefault()"></i>
                                                        Eliminar</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr/>
                    <div class="text-right">
                        @var $parameter = $retailerProduct->parameters()->where('slug', 'GE')->first()

                        @if($parameter instanceof \Sibas\Entities\ProductParameter && $header->details->count() < $parameter->detail)
                            <button type="button" class="btn btn-primary" ng-click="create($event)"
                                    data-url="{{ route('au.vh.create', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}">
                                Agregar Vehículo <i class="icon-plus22 position-right"></i></button>
                        @endif

                        @if($header->details->count() > 0)
                            <a href="{{ route('au.result', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}"
                               class="btn btn-primary">
                                Continuar <i class="icon-arrow-right14 position-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection