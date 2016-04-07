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
                    <li class="active">Emisión</li>
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
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">2</span> Datos del Vehículo
                                    </a>
                                </li>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">3</span> Resultado Cotización
                                    </a>
                                </li>
                                <li class="current">
                                    <a href="#">
                                        <span class="current-info audible">current step: </span>
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

                @if(session('success_client'))
                    <script>
                        $(function () {
                            messageAction('succes', "{{ session('success_client') }}");
                        });
                    </script>
                @endif

                @if(session('error_header'))
                    <div class="alert bg-danger alert-styled-right">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span>
                        </button>
                        <span class="text-semibold">{{ session('error_header') }}</span>.
                    </div>
                @endif

                <div class="panel-body ">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="modal-header bg-primary recuadro">
                            <div class="panel-heading">
                                <h6 class="modal-title">Información del CLIENTE</h6>
                            </div>
                        </div>
                        <div class="panel panel-body border-top-success">
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <div class="col-lg-5">
                                        <strong>Nombre Completo: </strong>
                                    </div>
                                    <div class="col-lg-7">
                                        {{ $header->client->full_name }}
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-xs-8 col-md-4 border-blue">
                                <div class="form-group">
                                    <div class="col-lg-3">
                                        <strong>C.I.: </strong>
                                    </div>
                                    <div class="col-lg-5">
                                        {{ $header->client->dni }} {{ $header->client->extension }}
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-xs-10 col-md-4">
                                <div class="form-group">
                                    <div class="col-lg-5">
                                        <strong>Fecha de Nacimiento: </strong>
                                    </div>
                                    <div class="col-lg-5">
                                        {{ dateToFormat($header->client->birthdate) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-md-4 pull-right">
                                <a href="{{ route('au.client.i.edit', [
                                    'rp_id'     => $rp_id,
                                    'header_id' => $header_id,
                                    'client_id' => encode($header->client->id) ]) }}"
                                   class="btn btn-default pull-right">
                                    @if($header->client_completed)
                                        <span class="label label-success">Completado</span>
                                    @else
                                        <span class="label label-danger">Pendiente</span>
                                    @endif
                                    Editar <i class="icon-pencil position-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10 col-md-offset-1">
                        <div class="modal-header bg-primary recuadro">
                            <div class="panel-heading">
                                <h6 class="modal-title">Datos del Vehículo</h6>
                            </div>
                        </div>
                        <div class="panel panel-body border-top-success">
                            <div class="col-xs-12 col-md-12">
                                <table class="table" ng-controller="DetailAuController">
                                    <thead>
                                    <tr>
                                        <th>Vehículo</th>
                                        <th>Marca / Modelo</th>
                                        <th>Cero Km.</th>
                                        <th>Año</th>
                                        <th>Placa</th>
                                        <th>Categoria</th>
                                        <th>Valor Comercial</th>
                                        <th>Status</th>
                                        <th class="text-center">Accion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($header->details as $key => $detail)
                                        <tr>
                                            <td><a href="#">{{ $detail->vehicleType->vehicle }}</a></td>
                                            <td>{{ $detail->vehicleMake->make }}
                                                / {{ $detail->vehicleModel->model }}</td>
                                            <td>{{ $detail->mileage_text }}</td>
                                            <td>{{ $detail->year }}</td>
                                            <td>{{ $detail->license_plate }}</td>
                                            <td>
                                                <span class="label label-success">{{ $detail->category->category_name }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ number_format($detail->insured_value, 2) }} {{ $header->currency }}</strong>
                                            </td>
                                            <td>
                                                @if($detail->completed)
                                                    <span class="label label-success">Completado</span>
                                                @else
                                                    <a href="{{ route('au.vh.i.edit', [
                                                        'rp_id'     => $rp_id,
                                                        'header_id' => $header_id,
                                                        'detail_id' => encode($detail->id)]) }}"
                                                       title="Pendiente" class="label label-danger"
                                                       ng-click="editIssuance($event)">
                                                        Pendiente
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="{{ route('au.vh.i.edit', [
                                                                    'rp_id'     => $rp_id,
                                                                    'header_id' => $header_id,
                                                                    'detail_id' => encode($detail->id)]) }}"
                                                                   ng-click="editIssuance($event)">
                                                                    <i class="icon-pencil3"
                                                                       ng-click="$event.stopPropagation(); $event.preventDefault()"></i>
                                                                    Editar</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10 col-md-offset-1">
                        <div class="modal-header bg-primary recuadro">
                            <div class="panel-heading">
                                <h6 class="modal-title">Datos del Crédito Solicitado</h6>
                            </div>
                        </div>

                        @if(! $header->issued)
                            @if($header->type === 'Q')
                                {!! Form::open(['route' => ['au.update',
                                    'rp_id'         => $rp_id,
                                    'header_id'     => $header_id
                                    ],
                                    'method'        => 'put',
                                    'class'         => 'form-horizontal',
                                    'ng-controller' => 'HeaderDeController'
                                ]) !!}
                            @elseif($header->type === 'I')
                                {!! Form::open(['route' => ['au.update.issuance',
                                    'rp_id'         => $rp_id,
                                    'header_id'     => $header_id
                                    ],
                                    'method'        => 'put',
                                    'class'         => 'form-horizontal',
                                    'ng-controller' => 'HeaderDeController'
                                ]) !!}
                            @endif
                        @endif

                        <div class="panel panel-body border-top-success">
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <div class="col-lg-5">
                                        <strong>Inicio de Vigencia: </strong>
                                    </div>
                                    <div class="col-lg-7">
                                        {{ dateToFormat($header->validity_start) }}
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <div class="col-lg-5">
                                        <strong>Plazo del Crédito: </strong>
                                    </div>
                                    <div class="col-lg-7">
                                        {{ $header->term }} {{ config('base.term_types.' . $header->type_term) }}
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <div class="col-lg-5">
                                        <strong>Forma de Pago: </strong>
                                    </div>
                                    <div class="col-lg-7">
                                        {{ config('base.payment_methods.' . $header->payment_method) }}
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <hr/>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 label_required">Número de
                                            Operación: </label>
                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <span class="input-group-addon">Nro.</span>
                                                {!! Form::text('operation_number', old('operation_number', $header->operation_number), [
                                                    'class'        => 'form-control ui-wizard-content',
                                                    'autocomplete' => 'off',
                                                    'placeholder'  => 'Número de Crédito'])
                                                !!}
                                            </div>
                                            <label id="location-error" class="validation-error-label"
                                                   for="location">{{ $errors->first('operation_number') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label label_required">Número de Póliza: </label>
                                        <div class="col-lg-9">
                                            {!! SelectField::input('policy_number', $data['policies']->toArray(), [
                                                'class' => 'select-search'],
                                                old('policy_number', $header->policy_number))
                                            !!}
                                            <label id="location-error" class="validation-error-label"
                                                   for="location">{{ $errors->first('policy_number') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>
                                <div class="text-right">
                                    @if($header->completed)
                                        @if(! $header->issued)
                                            @if($header->type === 'Q')
                                                <button type="submit" class="btn btn-primary">Guardar <i
                                                            class="glyphicon glyphicon-floppy-disk position-right"></i>
                                                </button>
                                            @elseif($header->type === 'I')
                                                <button type="submit" class="btn btn-primary">Emitir <i
                                                            class="glyphicon glyphicon-floppy-disk position-right"></i>
                                                </button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>

                        {!! Form::close() !!}
                    </div>


                </div>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection