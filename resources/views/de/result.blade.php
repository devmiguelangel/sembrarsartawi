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
                            <span class="form-wizard-count">3</span>
                            Seguro de Desgravamen
                            <small class="display-block">Tenemos las siguientes ofertas para ti</small>
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
                            <li class="current">
                                <a href="#">
                                    <span class="current-info audible">current step: </span>
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

                @if(session('error_header'))
                    <div class="alert bg-danger alert-styled-right">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">{{ session('error_header') }}</span>.
                    </div>
                @endif

                <div class="panel-body ">
                    <div class="col-xs-12 col-md-12">
                        @foreach($retailer->retailerProducts as $retailerProduct)
                            @if($retailerProduct->first()->id === decode($rp_id))
                                @if($retailerProduct->companyProduct->product->code === 'de' && $retailerProduct->type === 'MP')
                                    @if($retailerProduct->rates->count() === 1)
                                        <div class="col-md-4 ">
                                            <div class="panel panel-body border-top-primary text-center">
                                                <div class="form-group">
                                                    {!! Html::image('images/' . $retailerProduct->companyProduct->company->image) !!}
                                                </div>
                                                <h6 class="no-margin text-semibold">Tasa del prestamo:</h6>
                                                <p class="text-muted content-group-sm">{{ $retailerProduct->rates->first()->rate_final }}%</p>
                                                <button type="button" class="btn btn-success"><i class="icon-file-check position-left"></i> Ver Cotización</button>
                                                <hr>
                                                {!! Form::open(['route' => ['de.store.result',  'rp_id' => $rp_id, 'header_id' => $header_id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                                    {!! Form::hidden('header_id', $header_id) !!}
                                                    {!! Form::hidden('rp_id', encrypt($rp_id)) !!}
                                                    {!! Form::hidden('rate_id', encrypt($retailerProduct->rates->first()->id)) !!}

                                                    {!! Form::button('<i class="icon-arrow-right14 position-left"></i> Emitir', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}

                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- /horizotal form -->
            </div>
        </div>
    </div>
@endsection
