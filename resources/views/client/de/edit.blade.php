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
                            {{ $client->full_name }}
                            <small class="display-block"></small>
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
                            <li class="current">
                                <a href="#">
                                    <span class="current-info audible">current step: </span>
                                    <span class="number">2</span> Datos del Titular
                                </a>
                            </li>
                            <li class="disabled last" >
                                <a href="#">
                                    <span class="number">3</span> Resultado Cotización
                                </a>
                            </li>
                            <li class="disabled last" >
                                <a href="#">
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

                @if(session('error_client_edit'))
                    <div class="alert bg-danger alert-styled-right">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">{{ session('error_client_edit') }}</span>.
                    </div>
                @endif

                {!! Form::open(['route' => ['de.detail.update',  'rp_id' => $rp_id, 'header_id' => $header_id, 'detail_id' => $detail_id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('header_id', $header_id) !!}
                    {!! Form::hidden('detail_id', $detail_id) !!}
                    {!! Form::hidden('rp_id', encrypt($rp_id)) !!}

                    <div class="panel-body ">
                        @include('client.de.partials.inputs-quote')

                        <div class="text-right">
                            <a href="{{ route('de.client.list', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}" class="btn border-slate text-slate-800 btn-flat">Cancelar</a>

                            {!! Form::button('Actualizar Cliente <i class="icon-arrow-right14 position-right"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-primary'])
                            !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>

            <!-- /horizotal form -->
        </div>
    </div>
@endsection