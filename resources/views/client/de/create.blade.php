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
                            Datos del Titular
                            <small class="display-block">Datos del Titular</small>
                        </span>
                        <span class="col-md-1">
                            <button style="float: left;" type="button" class="btn btn-rounded btn-default text-right" data-popup="tooltip" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                                <i class="icon-question7"></i> Producto
                            </button>
                        </span>
                    </h6>
                </div>
                @if(session('err_detail'))
                    <div class="alert alert-warning alert-styled-left">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">{{ session('err_detail') }}</span>
                    </div>
                @endif

                {!! Form::open(['route' => ['de.detail.store',  'rp_id' => (isset($rp_id) ? $rp_id : route()->get('rp_id')), 'header_id' => (isset($header_id) ? $header_id : route()->get('header_id'))], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('header_id', $header_id) !!}
                    {!! Form::hidden('rp_id', encrypt($rp_id)) !!}

                    @include('client.de.partials.inputs-quote')

                {!! Form::close() !!}
            </div>

            <!-- /horizotal form -->
        </div>
    </div>
@endsection