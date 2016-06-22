<!--edw-->
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
                <h4><i class="icon-arrow-left52 position-left"></i>
                    <span class="text-semibold">Seguro de Multiriesgo</span>
                </h4>
                <ul class="breadcrumb breadcrumb-caret position-right">
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Datos del Cliente</a></li>
                    <li><a href="">Datos del Iteres Asegurado</a></li>
                    <li><a href="">Resultado Cotizaci&oacute;n</a></li>
                    <li><a href="">Emici&oacute;n de P&oacute;liza Seguro de Multiriesgo</a></li>
                    <li class="active">Impresión de la Póliza</li>
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
                                        <span class="number">1</span> Datos del Cliente
                                    </a>
                                </li>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">2</span> Datos del Interes Asegurado
                                    </a>
                                </li>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">3</span> Resultado Cotización
                                    </a>
                                </li>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">4</span> Emisión de Póliza Seguro de Multiriesgo
                                    </a>
                                </li>
                                <li class="current" id="finish">
                                    <a href="#">
                                        <span class="number">5</span> Impresion de la Póliza
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
                <div class="clearfix"></div>
                @if(session('error_header'))
                    <script>
                        $(function () {
                            messageAction('error', "{{ session('error_header') }}");
                        });
                    </script>
                @endif

                @if(session('success_header'))
                    <script>
                        $(function () {
                            messageAction('succes', "{{ session('success_header') }}");
                        });
                    </script>
                @endif

                <div class="panel-body ">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="modal-header bg-primary">
                            <h6 class="modal-title">Póliza {{ $header->prefix }} - {{ $header->issue_number }}</h6>
                        </div>
                        <div class="panel panel-body border-top-primary text-center">
                            <p class="text-muted content-group-sm">Cotizacion/Emisión </p>
                            <div class="col-md-12">
                                <p>
                                    <a href="{{route('create_modal_slip', ['id_retailer_product'=>$rp_id, 'id_header'=>encode($header->id), 'text'=>'print_all', 'type'=>'IMPR'])}}"
                                       id="print_all" class="btn btn-primary btn-labeled btn-xlg col-lg-12 open_modal">
                                        <b><i class="icon-printer4"></i></b> Imprimir Todo
                                    </a>
                                </p>
                                <div class="col-md-12">&nbsp;</div>
                                <p>
                                    <a href="{{route('create_modal_slip', ['id_retailer_product'=>$rp_id, 'id_header'=>encode($header->id), 'text'=>'slip', 'type'=>'IMPR'])}}"
                                       id="slip" class="btn btn-info btn-labeled btn-xlg col-lg-12 open_modal">
                                        <b><i class="icon-printer4"></i></b> Ver Slip de Cotización
                                    </a>
                                </p>
                                <div class="col-md-6">&nbsp;</div>
                                <p>
                                    <a href="{{route('create_modal_slip', ['id_retailer_product'=>$rp_id, 'id_header'=>encode($header->id), 'text'=>'issuance', 'type'=>'IMPR'])}}"
                                       id="issuance" class="btn btn-info btn-labeled btn-xlg col-lg-12 open_modal">
                                        <b><i class="icon-printer4"></i></b> Ver Certificado de Emision
                                    </a>
                                </p>
                                <div class="col-md-6">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>

    @include('partials.modal_content')

@endsection
