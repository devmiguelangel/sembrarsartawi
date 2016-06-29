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
                    <li class="active">Resultado Cotizaci&oacute;n</li>
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
                                <li class="current">
                                    <a href="#">
                                        <span class="number">3</span> Resultado Cotización
                                    </a>
                                </li>
                                <li class="disabled last">
                                    <a href="#">
                                        <span class="number">4</span> Emisión de Póliza Seguro de Multiriesgo
                                    </a>
                                </li>
                                <li class="disabled last">
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
                    <div class="alert bg-danger alert-styled-right">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span>
                        </button>
                        <span class="text-semibold">{{ session('error_header') }}</span>.
                    </div>
                @endif

                <div class="panel-body ">
                    <div class="col-xs-12 col-md-12">

                        <div class="col-md-4 ">
                            <div class="panel panel-body border-top-primary text-center">
                                <div class="form-group">
                                    {!! Html::image($retailerProduct->companyProduct->company->image, null, ['style' => 'max-height: 130px;']) !!}
                                </div>
                                <h6 class="no-margin text-semibold">Prima Total:</h6>
                                <p class="text-muted content-group-sm">{{ $header->currency }} {{ number_format($header->total_premium, 2) }}</p>
                                @if($facultative['facultative']>0)
                                    <div class="alert alert-danger">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>
                                        Prima referencial, sujeta a la aprobación de la compañía
                                    </div>
                                @endif

                                <a href="{{route('create_modal_slip', ['id_retailer_product'=>$rp_id, 'id_header'=>$header_id, 'text'=>'slip', 'type'=>'IMPR'])}}"
                                   id="slip" class="btn btn-success open_modal">
                                    <i class="icon-file-check position-left"></i> Ver Cotización
                                </a>
                                <hr>

                                <a href="{{ route('td.emision_poliza', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}"
                                   class="btn btn-primary"><i class="icon-arrow-right14 position-left"></i>
                                    Emitir
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- /horizotal form -->
            </div>
        </div>
    </div>
    @include('partials.modal_content')
@endsection
