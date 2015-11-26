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
                            <span class="form-wizard-count">1</span>
                            Datos del Prestamo
                            <small class="display-block">Información inicial del préstamo</small>
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
                            <li class="current">
                                <a href="#">
                                    <span class="current-info audible">current step: </span>
                                    <span class="number">1</span> Datos del Prestamo
                                </a>
                            </li>
                            <li class="disabled last" >
                                <a href="#">
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
                <br>

                @if(session('err_header'))
                    <div class="alert alert-warning alert-styled-left">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">{{ session('err_header') }}</span>
                    </div>
                @endif
                <br>
                <div class="panel-body ">
                    <div class="col-xs-8">
                        {!! Form::open(['route' => ['de.store', 'rp_id' => $rp_id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            {!! Form::hidden('rp_id', encrypt($rp_id)) !!}
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Tipo de cobertura: </label>
                                <div class="col-lg-8">
                                    {!! SelectField::input('coverage', $data['coverages']->toArray(), ['class' => 'select-search'], old('coverage')) !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('coverage') }}</label>
                                </div>
                                <div class="col-lg-1">
                                    <a onclick="$('#cobertura').show();
                                                            $('#monto').hide();"><i class="icon-question7 " data-popup="tooltip" title="Mas detalle"></i></a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Monto solicitado: </label>
                                <div class="col-lg-4">
                                    {!! Form::text('amount_requested', 0, [
                                        'class' => 'touchspin-set-value',
                                        'autocomplete' => 'off'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('amount_requested') }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="icon-coins"></i>
                                        </div>
                                        {!! SelectField::input('currency', $data['currencies']->toArray(), ['class' => 'bootstrap-select'], old('currency')) !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('currency') }}</label>
                                </div>
                                <div class="col-lg-1">
                                    <a onclick="$('#monto').show();
                                                            $('#cobertura').hide();"><i class="icon-question7 " data-popup="tooltip" title="Mas detalle"></i></a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Plazo crédito: </label>
                                <div class="col-lg-4">
                                    {!! Form::text('term', 0, [
                                        'class' => 'touchspin-set-value',
                                        'autocomplete' => 'off'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('term') }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-sort-time-asc"></i></span>
                                        {!! SelectField::input('type_term', $data['term_types']->toArray(), ['class' => 'bootstrap-select'], old('type_term')) !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('type_term') }}</label>
                                </div>
                                <div class="col-lg-1">
                                </div>
                            </div>
                            <div class="text-right">
                                {!! Form::button('Cotiza tu mejor seguro <i class="icon-arrow-right14 position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="col-xs-4">
                        <div class="thumbnail">
                            <div class="caption text-justyfi" id="cobertura">
                                <h6 class="no-margin-top text-semibold">Tipo de cobertura</h6>
                                <p>La cobertura amplia es más completa protección a tu vehículo La cobertura limitada no cubre los daños del automóvil. La cobertura de responsabilidad civil o daños a terceros, te brinda la protección mínima para tu auto, no cubre el los daños materiales, ni el robo del automóvil.</p>
                                <p>Para el hogar cuentan con diferentes tipos de cobertura de seguros que van para tu casa o departamento, instalaciones, antenas, cristales, pisos y alfombras, bombas de agua. Los contenidos de tu hogar: ropa, libros, muebles, electrodomésticos y electrónicos, artículos deportivos, además de obras de arte y joyas. Objetos personales fuera del domicilio por robo y/o asalto. Trabajadores domésticos mientras desempeñan sus funciones. Contra riesgos naturales como terremotos, inundaciones, rayos, entre otros. Contra riesgos accidentales como incendio, explosión, caída y rotura de bienes, humo, etc.</p>
                            </div>
                            <div class="caption text-justyfi" id="monto" style="display: none">
                                <h6 class="no-margin-top text-semibold">Monto solicitado</h6>
                                presenta la propuesta ante el comité de créditos, el cual se reúne en la sucursal que corresponda o en la casa matriz de la entidad financiera especializada (dependiendo del monto del crédito solicitado)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection