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
                            <span class="form-wizard-count">6</span>
                            Imprisión de Póliza
                            <small class="display-block">Impresión de Poliza Emitida</small>
                        </span>
                        <span class="col-md-1">
                            <button style="float: left;" type="button" class="btn btn-rounded btn-default text-right" data-popup="tooltip" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                                <i class="icon-question7"></i> Producto
                            </button>
                        </span>
                    </h6>
                </div>
                <br />

                <div class="panel-body ">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-body border-top-primary text-center">
                            <h6 class="no-margin text-semibold">Póliza DE-41089</h6>
                            <p class="text-muted content-group-sm">Cotizacion/Emisión </p>
                            <div class="col-md-12 col-md-offset-2">
                                <p><button type="button" class="btn btn-primary btn-labeled btn-xlg col-lg-7" data-toggle="modal" data-target="#modal_slip"><b><i class="icon-printer4"></i></b> Imprimir Todo</button></p>
                                <div class="col-md-12">&nbsp;</div>
                                <p><button type="button" class="btn btn-info btn-labeled btn-xlg col-lg-7" data-toggle="modal" data-target="#modal_slip"><b><i class="icon-printer4"></i></b> Ver Slip de Cotización</button></p>
                                <div class="col-md-6">&nbsp;</div>
                                <p><button type="button" class="btn btn-info btn-labeled btn-xlg col-lg-7" data-toggle="modal" data-target="#modal_slip"><b><i class="icon-printer4"></i></b> Ver Certificado de Desgravamen</button></p>
                                <div class="col-md-6">&nbsp;</div>
                                <p><button type="button" class="btn btn-info btn-labeled btn-xlg col-lg-7" data-toggle="modal" data-target="#modal_slip"><b><i class="icon-printer4"></i></b> Ver Carta Debito </button></p>
                                <div class="col-md-6">&nbsp;</div>
                                <p><button type="button" class="btn btn-info btn-labeled btn-xlg col-lg-7" data-toggle="modal" data-target="#modal_slip"><b><i class="icon-printer4"></i></b> Ver Formulario UIF</button></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection