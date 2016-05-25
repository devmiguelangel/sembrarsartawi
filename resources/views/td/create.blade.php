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
            <h4><i class="icon-arrow-left52 position-left"></i> <span
                    class="text-semibold">Seguro de Multiriesgo</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="">Inicio</a></li>
                <li><a href="">Multiriesgo</a></li>
                <li class="active">Cotizar</li>
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
                            <li class="current">
                                <a href="#">
                                    <span class="number">1</span> Datos del Cliente
                                </a>
                            </li>
                            <li class="disabled last">
                                <a href="#">
                                    <span class="number">2</span> Datos del Interes Asegurado
                                </a>
                            </li>
                            <li class="disabled last">
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

            @if(session('error_header'))
            <div class="alert alert-danger alert-styled-right">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span>
                </button>
                <span class="text-semibold">{{ session('error_header') }}</span>.
            </div>
            @endif

            @if(session('error_client'))
            <script>
                $(function() {
                    messageAction('info', "{{ session('error_client') }}");
                });
            </script>
            @endif

            <div class="col-xs-12">
                <div class="col-md-8 col-md-offset-2">
                    {!! Form::open(['route' => ['client.search', 'rp_id' => $rp_id], 'method' => 'get', 'class' => 'form-horizontal']) !!}
                    <div class="form-group has-success">
                        <label class="control-label col-lg-4 text-semibold" style="text-align: right;">
                            Busqueda de datos:</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-search4"></i></span>
                                {!! Form::text('dni', old('dni'), [
                                'class'        => 'form-control',
                                'placeholder'  => 'Ingrese Documento de identidad',
                                'autocomplete' => 'off'
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            {!! Form::button('Buscar <i class="icon-search4"></i>', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <br><br><br>

            <div class="panel-body ">
                {!! Form::open(['route' => ['td.store', 'rp_id' => $rp_id],
                'method'        => 'post',
                'class'         => 'form-horizontal',
                'ng-controller' => 'HeaderAuController',
                ]) !!}
                <ul>
                   <!-- 
                @foreach($errors->all() as $error )
                <li>{{ $error }}</li>
                
                @endforeach
                -->
                </ul>
                <div class="panel-body ">
                    <h2>Datos del Cliente</h2>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label class="col-lg-3 control-label label_required">Nombres: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                    {!! Form::text('first_name', old('first_name', $client->first_name), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'Nombres',
                                    'autocomplete' => 'off'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('first_name') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label label_required">Apellido Paterno: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                    {!! Form::text('last_name', old('last_name', $client->last_name), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'Ap. Paterno',
                                    'autocomplete' => 'off'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('last_name') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Apellido Materno: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                    {!! Form::text('mother_last_name', old('mother_last_name', $client->mother_last_name), [
                                    'class'        => 'form-control',
                                    'placeholder'  => 'Ap. Materno',
                                    'autocomplete' => 'off'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('mother_last_name') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Apellido de Casada: </label>
                            <div class="col-lg-9">
                                {!! Form::text('married_name', old('married_name', $client->married_name), [
                                'class'        => 'form-control',
                                'placeholder'  => 'Ap. de casada',
                                'autocomplete' => 'off'
                                ]) !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('married_name') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Avenida o Calle: </label>
                            <div class="col-lg-9">
                                {!! SelectField::input('avenue_street', $data['avenue_street']->toArray(), [
                                'class' => 'select-search',
                                'id'    => 'avenue_street',
                                ],
                                old('avenue_street'))
                                !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('avenue_street') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> Dirección: </label>
                            <div class="col-lg-9">
                                {!! Form::textarea('home_address', old('home_address', $client->home_address), [
                                'size'        => '4x4',
                                'class'       => 'form-control',
                                'placeholder' => 'Dirección'
                                ]) !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('home_address') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Número: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon">Nro</span>
                                    {!! Form::text('home_number', old('home_number', $client->home_number), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'Número',
                                    'autocomplete' => 'off'
                                    ]) !!}
                                    <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('home_number') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Ciudad / Localidad: </label>
                            <div class="col-lg-9">    
                                {!! Form::text('locality', old('locality', $client->locality), [
                                'class'        => 'form-control ui-wizard-content',
                                'placeholder'  => 'Ciudad / Localidad',
                                'autocomplete' => 'off'
                                ]) !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('locality') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label label_required">Teléfono de domicilio: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-phone"></i></span>
                                    {!! Form::text('phone_number_home', old('phone_number_home', $client->phone_number_home), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'Teléfono de domicilio',
                                    'autocomplete' => 'off'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('phone_number_home') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Telef. Oficina: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-phone"></i></span>
                                    {!! Form::text('phone_number_office', old('phone_number_office', $client->phone_number_office), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'Telef. Oficina',
                                    'autocomplete' => 'off'
                                    ]) !!}
                                    <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('phone_number_office') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Teléfono celular: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    {!! Form::text('phone_number_mobile', old('phone_number_mobile', $client->phone_number_mobile), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'Telefono celular',
                                    'autocomplete' => 'off'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('phone_number_mobile') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    {!! Form::email('email', old('email', $client->email), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'mail@email.com',
                                    'autocomplete' => 'off'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('email') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label label_required">Documento de Identidad: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon">C.I.</span>
                                    {!! Form::text('dni', old('dni', $client->dni), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'Documento de identidad',
                                    'autocomplete' => 'off'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('dni') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Complemento: </label>
                            <div class="col-lg-9">
                                {!! Form::text('complement', old('complement', $client->complement), [
                                'class'        => 'form-control ui-wizard-content',
                                'placeholder'  => 'Complemento',
                                'autocomplete' => 'off'
                                ]) !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('complement') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label label_required">Extensión: </label>
                            <div class="col-lg-9">
                                {!! SelectField::input('extension', $data['cities']['CI']->toArray(), [
                                'class' => 'select-search'],
                                old('extension', $client->extension))
                                !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('extension') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label label_required">Género: </label>
                            <div class="col-lg-9">
                                {!! SelectField::input('gender', $data['gender']->toArray(), [
                                'class' => 'select-search'],
                                old('gender', $client->gender))
                                !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('gender') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3 label_required">Fecha de nacimiento: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    {!! Form::text('birthdate', old('birthdate', dateToFormat($client->birthdate)), [
                                    'class'        => 'form-control pickadate-cobodate',
                                    'autocomplete' => 'off',
                                    'placeholder'  => 'Seleccione fecha'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('birthdate') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> Dirección Laboral: </label>
                            <div class="col-lg-9">
                                {!! Form::textarea('business_address', old('business_address', $client->business_address), [
                                'size'        => '4x4',
                                'class'       => 'form-control',
                                'placeholder' => 'Dirección Laboral'
                                ]) !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('business_address') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label label_required">Ocupación: </label>
                            <div class="col-lg-9">
                                {!! SelectField::input('ad_activity_id', $data['activities']->toArray(), [
                                'class' => 'select-search'],
                                old('ad_activity_id', $client->ad_activity_id))
                                !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('ad_activity_id') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3 label_required">Descripción Ocupación: </label>
                            <div class="col-lg-9">
                                {!! Form::textarea('occupation_description', old('occupation_description', $client->occupation_description), [
                                'size'        => '4x4',
                                'class'       => 'form-control',
                                'placeholder' => 'Descripción ocupación'
                                ]) !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('occupation_description') }}</label>
                            </div>
                        </div>

                    </div>

                    <div class="col-xs-12 col-md-12">
                        <hr/>
                    </div>
                    <div class="clearfix"></div>

                    <h2>Datos del Seguro Solicitado</h2>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label class="control-label col-lg-3 label_required">Garantía: </label>
                            <div class="col-lg-9">
                                <label class="radio-inline">
                                    {!! Form::radio('warranty', 1, true, ['class' => 'styled']) !!}
                                    Con Garantía
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('warranty', 0, false, ['class' => 'styled']) !!}
                                    No es objeto de Garantía
                                </label>
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('warranty') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3 label_required">Inicio de Vigencia: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    {!! Form::text('validity_start', old('validity_start'), [
                                    'class'        => 'form-control pickadate-cobodate',
                                    'autocomplete' => 'off',
                                    'placeholder'  => 'Seleccione fecha'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('validity_start') }}</label>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label class="col-lg-3 control-label label_required">Plazo del Crédito: </label>
                            <div class="col-lg-3">
                                {!! Form::text('term', old('term', ''), [
                                'class'        => 'form-control',
                                'autocomplete' => 'off',
                                'id'           => 'term',
                                ]) !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('term') }}</label>
                            </div>
                            <div class="col-lg-6">
                                {!! SelectField::input('type_term', $data['term_types']->toArray(), [
                                'class' => 'form-control',
                                'id'    => 'type_term',
                                ], old('type_term')) !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('type_term') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label label_required">Moneda: </label>
                            <div class="col-lg-9">
                                {!! SelectField::input('currency', $data['currencies']->toArray(), [
                                'class' => 'select-search',
                                'id'    => 'currency',
                                ],
                                old('currency'))
                                !!}
                                <label id="location-error" class="validation-error-label"
                                       for="location">{{ $errors->first('currency') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="text-right">
                    {!! Form::button('Guardar <i class="glyphicon glyphicon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /horizotal form -->
    </div>
</div>
@endsection