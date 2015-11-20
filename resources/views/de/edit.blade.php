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
            @if(session()->has('header_update'))
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold">Well done!</span> You successfully read <a href="#" class="alert-link">this important</a> alert message.
                </div>
            @endif
            <!-- Horizontal form -->
            <div class="panel panel-flat border-top-primary">
                <div class="panel-heading divhr">
                    <h6 class="form-wizard-title2 text-semibold">
                        <span class="col-md-11">
                            <span class="form-wizard-count">5</span>
                            Emisión de Póliza de Desgravamen
                            <small class="display-block">Emisión de Póliza</small>
                        </span>
                        <span class="col-md-1">
                            <button style="float: left;" type="button" class="btn btn-rounded btn-default text-right" data-popup="tooltip" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                                <i class="icon-question7"></i> Producto
                            </button>
                        </span>
                    </h6>
                </div>
                <br />
                <table class="table datatable-basic">
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
                            <td><span class="label label-success">Completado</span></td>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="{{ route('de.detail.i.edit', [
                                                    'rp_id'     => $rp_id,
                                                    'header_id' => $header_id,
                                                    'detail_id' => encode($detail->id),
                                                    'ref'       => 'ise']) }}">
                                                    <i class="icon-pencil3"></i> Editar datos del cliente
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('de.beneficiary.create', [
                                                    'rp_id'     => $rp_id,
                                                    'header_id' => $header_id,
                                                    'detail_id' => encode($detail->id)]) }}">
                                                    <i class="icon-plus2"></i> Registrar Benficiario
                                                </a>
                                            </li>
                                            <li><a href="#" data-toggle="modal" data-target="#modal_saldo_deudor"><i class="icon-plus2"></i> Registrar Saldo deudor</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-xs-12 col-md-12">
                    <h4>Datos del Crédito Solicitado</h4>
                </div>

                {!! Form::open(['route' => ['de.update',  'rp_id' => $rp_id, 'header_id' => $header_id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('header_id', $header_id) !!}
                    {!! Form::hidden('rp_id', encrypt($rp_id)) !!}
                    <div class="panel-body ">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Tipo de Cobertura: </label>
                                <div class="col-lg-9">
                                    {!! SelectField::input('coverage', $data['coverages']->toArray(), [
                                        'class' => 'select-search'],
                                        old('coverage', $header->coverage->id))
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('coverage') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3  label_required">Monto Actual Solicitado: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-cash2"></i></span>
                                        {!! Form::text('amount_requested', old('amount_requested', $header->amount_requested), [
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'Monto Actual Solicitado',
                                            'readonly' => 'readonly'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('amount_requested') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Moneda: </label>
                                <div class="col-lg-9">
                                    {!! SelectField::input('currency', $data['currencies']->toArray(), [
                                        'class' => 'bootstrap-select'],
                                        old('currency', $header->currency))
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('currency') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Plazo del Credito: </label>
                                <div class="col-lg-3">
                                    {!! Form::text('term', old('term', $header->term), [
                                        'class' => 'form-control ui-wizard-content',
                                        'autocomplete' => 'off',
                                        'placeholder' => 'Plazo del Credito',
                                        'readonly' => 'readonly'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('term') }}</label>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-sort-time-asc"></i></span>
                                        {!! SelectField::input('type_term', $data['term_types']->toArray(), [
                                            'class' => 'select-search'], old('type_term', $header->type_term))
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('type_term') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label col-lg-3">Número de Operación: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('operation_number', old('operation_number', $header->operation_number), [
                                        'class' => 'form-control ui-wizard-content',
                                        'autocomplete' => 'off',
                                        'placeholder' => 'Número de Operación'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('operation_number') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Número de Póliza: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">Nro</span>
                                        {!! Form::text('policy_number', old('policy_number', $header->policy_number), [
                                            'class' => 'form-control ui-wizard-content',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'Nombre de Póliza'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('policy_number') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            @if($header->type === 'Q')
                                {!! Form::button('Guardar <i class="icon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            @elseif($header->type === 'I')
                                <a href="{{ route('de.issue', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}" class="btn btn-primary">
                                    Emitir <i class="icon-floppy-disk position-right"></i>
                                </a>
                            @endif

                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection