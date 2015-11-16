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
                            <span class="form-wizard-count">4</span>
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
                <br />


                <div class="panel-body ">
                    <div class="col-xs-12 col-md-12">
                        @foreach($retailer->retailerProducts as $retailerProduct)
                            @if($retailerProduct->first()->id === decode($rp_id))
                                <?php $rates = $retailerProduct->rates ?>
                                @if($rates->count() === 1)
                                    <div class="col-md-4 ">
                                        <div class="panel panel-body border-top-primary text-center">
                                            <div class="form-group">
                                                {!! Html::image('images/' . $retailer->image) !!}
                                            </div>
                                            <h6 class="no-margin text-semibold">Tasa del prestamo:</h6>
                                            <p class="text-muted content-group-sm">{{ $rates->first()->rate_final }}%</p>
                                            <button type="button" class="btn btn-success"><i class="icon-file-check position-left"></i> Ver Cotización</button>
                                            <hr>
                                            <button type="button" class="btn btn-primary"><i class="icon-arrow-right14 position-left"></i> Emitir</button>
                                        </div>
                                    </div>
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
