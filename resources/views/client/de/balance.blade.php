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
                    <li class="active">Saldo Deudor</li>
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
                        <span class="col-md-11">
                            <span class="form-wizard-count">4</span>
                            Datos del Saldo deudor
                            <small class="display-block">Titular {{ $detail->client->full_name }}</small>
                        </span>
                        <span class="col-md-1">
                            <button style="float: left;" type="button" class="btn btn-rounded btn-default text-right" data-popup="tooltip" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                                <i class="icon-question7"></i> Producto
                            </button>
                        </span>
                    </h6>
                </div>

                <div class="steps-basic2 wizard">
                    <div class="steps">
                        <ul>
                            <li class="first done">
                                <a href="#">
                                    <span class="number">1</span> Datos del Prestamo
                                </a>
                            </li>
                            <li class="first done">
                                <a href="#">
                                    <span class="number">2</span>Datos del Titular
                                </a>
                            </li>
                            <li class="first done">
                                <a href="#">
                                    <span class="number">2</span>Resultado Cotización
                                </a>
                            </li>
                            <li class="current">
                                <a href="#">
                                    <span class="current-info audible">current step: </span>
                                    <span class="number">4</span> Emisión de la Póliza de Desgravamen
                                </a>
                            </li>
                            <li class="disabled last" >
                                <a href="#">
                                    <span class="number">5</span> Impresión de la Póliza
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                @if(session('error_detail'))
                    <div class="alert bg-danger alert-styled-right">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">{{ session('error_detail') }}</span>.
                    </div>
                @endif

                <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
                    <!--<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>-->
                    <h6 class="alert-heading text-semibold">Importante</h6>
                    Comprobar y validar saldos para deuda directa titular en créditos paralelos y refinanciados.
                </div>

                {!! Form::open(['route' => ['de.detail.balance.update', 'rp_id' => $rp_id, 'header_id' => encode($header->id), 'detail_id' => encode($detail->id)], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        <label class="control-label col-lg-3  label_required">Monto Actual Solicitado: </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-cash2"></i></span>
                                {!! Form::text('amount_requested', old('amount_requested', $header->amount_requested), [
                                    'class' => 'form-control',
                                    'readonly' => 'true',
                                    'placeholder' => 'Monto Actual Solicitado',
                                    'autocomplete' => 'off'])
                                !!}
                            </div>
                            <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('amount_requested') }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3  label_required">Saldo deudor actual del asegurado (Bs.): </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-cash2"></i></span>
                                {!! Form::text('balance', old('balance', $detail->balance), [
                                    'class' => 'form-control',
                                    'placeholder' => 'Saldo deudor actual del asegurado (Bs.)',
                                    'autocomplete' => 'off'])
                                !!}
                            </div>
                            <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('balance') }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6 col-md-offset-3">
                            <div class="input-group">
                                <h6 class="no-margin text-semibold">Monto Actual Acumulado</h6>
                                <p class="text-muted content-group-sm">{{ $detail->cumulus }} Bs. </p>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('de.edit', ['rp_id' => $rp_id, 'header_id' => encode($header->id)]) }}" class="btn border-slate text-slate-800 btn-flat">Cancelar</a>

                        {!! Form::button('Actualizar <i class="icon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div>

            <!-- /horizotal form -->
        </div>
    </div>
@endsection