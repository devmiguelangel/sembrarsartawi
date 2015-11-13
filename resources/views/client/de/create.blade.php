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
                            Datos del Titular 1 o Titular 2
                            <small class="display-block">Datos del Titular 1 o Titular 2</small>
                        </span>
                        <span class="col-md-1">
                            <button style="float: left;" type="button" class="btn btn-rounded btn-default text-right" data-popup="tooltip" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                                <i class="icon-question7"></i> Producto
                            </button>
                        </span>
                    </h6>
                </div>
                <br />

                {!! Form::open(['route' => ['de.client.store', $header_id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('header_id', $header_id) !!}
                    <div class="panel-body ">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label col-lg-3">Nombres: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('first_name', old('first_name'), [
                                        'class' => 'form-control ui-wizard-content',
                                        'placeholder' => 'Nombres',
                                        'required' => 'required'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('first_name') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3  label_required">Ap. Paterno: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('last_name', old('last_name'), [
                                        'class' => 'form-control ui-wizard-content',
                                        'placeholder' => 'Ap. Paterno',
                                        'required' => 'required'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('last_name') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Ap. Materno: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('mother_last_name', old('mother_last_name'), [
                                        'class' => 'form-control',
                                        'placeholder' => 'Ap. Materno',
                                        'required' => 'required'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('mother_last_name') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Ap. de casada: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('married_name', old('married_name'), [
                                        'class' => 'form-control',
                                        'placeholder' => 'Ap. de casada'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('married_name') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Estado Civil: </label>
                                <div class="col-lg-9">
                                    {!! SelectField::input('civil_status', $data['civil_status']->toArray(), ['class' => 'select-search'], old('civil_status')) !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('civil_status') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Tipo de documento:</label>
                                <div class="col-lg-9">
                                    {!! SelectField::input('document_type', $data['document_type']->toArray(), ['class' => 'select-search'], old('document_type')) !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('document_type') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Documento de identidad: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('dni', old('dni'), [
                                        'class' => 'form-control ui-wizard-content',
                                        'placeholder' => 'Documento de identidad',
                                        'required' => 'required'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('dni') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Complemento: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('complement', old('complement'), [
                                        'class' => 'form-control ui-wizard-content',
                                        'placeholder' => 'Complemento',
                                        'required' => 'required'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('complement') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Ext. Documento de identidad: </label>
                                <div class="col-lg-9">
                                    {!! SelectField::input('extension', $data['cities']['CI']->toArray(), ['class' => 'select-search', 'required' => 'required'], old('extension')) !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('extension') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">País: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('country', old('country'), [
                                        'class' => 'form-control ui-wizard-content',
                                        'placeholder' => 'País',
                                        'required' => 'required'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('country') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Fecha de nacimiento: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        {!! Form::text('birthdate', old('birthdate'), [
                                            'class' => 'form-control daterange-single',
                                            'required' => 'required'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('birthdate') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Lugar de nacimiento: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('birth_place', old('birth_place'), [
                                        'class' => 'form-control ui-wizard-content',
                                        'placeholder' => 'Lugar de nacimiento',
                                        'required' => 'required'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('birth_place') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Lugar de residencia: </label>
                                <div class="col-lg-9">
                                    {!! SelectField::input('place_residence', $data['cities']['DE']->toArray(), ['class' => 'select-search', 'required' => 'required'], old('place_residence')) !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('place_residence') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Localidad: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('locality', old('locality'), [
                                        'class' => 'form-control ui-wizard-content',
                                        'placeholder' => 'Localidad',
                                        'required' => 'required'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('locality') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">

                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Dirección: </label>
                                <div class="col-lg-9">
                                    {!! Form::textarea('home_address', old('home_address'), [
                                        'size' => '4x4',
                                        'class' => 'form-control',
                                        'placeholder' => 'Dirección',
                                        'required' => 'required'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('home_address') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Ocupación (CAEDEC): </label>
                                <div class="col-lg-9">
                                    {!! SelectField::input('ad_activity_id', $data['activities']->toArray(), ['class' => 'select-search', 'required' => 'required'], old('ad_activity_id')) !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('ad_activity_id') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Descripción ocupación: </label>
                                <div class="col-lg-9">
                                    {!! Form::textarea('occupation_description', old('occupation_description'), [
                                        'size' => '4x4',
                                        'class' => 'form-control',
                                        'placeholder' => 'Descripción ocupación',
                                        'required' => 'required'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('occupation_description') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Telefono 1: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-phone"></i></span>
                                        {!! Form::text('phone_number_home', old('phone_number_home'), [
                                            'class' => 'form-control ui-wizard-content',
                                            'placeholder' => 'Telefono 1',
                                            'required' => 'required'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('phone_number_home') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Telefono 2: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-phone"></i></span>
                                        {!! Form::text('phone_number_mobile', old('phone_number_mobile'), [
                                            'class' => 'form-control ui-wizard-content',
                                            'placeholder' => 'Telefono 2'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('phone_number_mobile') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Telef. Oficina: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-phone"></i></span>
                                        {!! Form::text('phone_number_office', old('phone_number_office'), [
                                            'class' => 'form-control ui-wizard-content',
                                            'placeholder' => 'Telef. Oficina'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('phone_number_office') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Correo electónico: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-mail5"></i></span>
                                        {!! Form::email('email', old('email'), [
                                            'class' => 'form-control ui-wizard-content required',
                                            'placeholder' => 'mail@email.com',
                                            'required' => 'required'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('email') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Peso: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">(Kg)</span>
                                        {!! Form::text('weight', old('weight'), [
                                            'class' => 'form-control ui-wizard-content',
                                            'placeholder' => 'Peso',
                                            'required' => 'required'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('weight') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Estatura: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">(cm)</span>
                                        {!! Form::text('height', old('height'), [
                                            'class' => 'form-control ui-wizard-content',
                                            'placeholder' => 'Estatura',
                                            'required' => 'required'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('height') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Género: </label>
                                <div class="col-lg-9">
                                    {!! SelectField::input('gender', $data['gender']->toArray(), ['class' => 'select-search'], old('gender')) !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('gender') }}</label>
                                </div>
                            </div>

                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Cotiza tu mejor seguro <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>

            <!-- /horizotal form -->
        </div>
    </div>
@endsection