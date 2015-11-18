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
                    <li class="active">Beneficiarios</li>
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
                            <span class="form-wizard-count">5</span>
                            Datos del Beneficiario
                            <small class="display-block">Titular</small>
                        </span>
                        <span class="col-md-1">
                            <button style="float: left;" type="button" class="btn btn-rounded btn-default text-right" data-popup="tooltip" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                                <i class="icon-question7"></i> Producto
                            </button>
                        </span>
                    </h6>
                </div>
                <br />

                {!! Form::open(['route' => ['de.beneficiary.store',  'rp_id' => $rp_id, 'header_id' => $header_id, 'detail_id' => $detail_id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('header_id', $header_id) !!}
                    {!! Form::hidden('detail_id', $detail_id) !!}
                    {!! Form::hidden('rp_id', encrypt($rp_id)) !!}

                    <div class="form-group">
                        <label class="control-label col-lg-3  label_required">Nombres: </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                                {!! Form::text('first_name', old('first_name', $beneficiary->first_name), [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nombres',
                                    'autocomplete' => 'off'])
                                !!}
                            </div>
                            <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('first_name') }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3  label_required">Ap. Paterno: </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                                {!! Form::text('last_name', old('last_name', $beneficiary->last_name), [
                                    'class' => 'form-control',
                                    'placeholder' => 'Ap. Paterno',
                                    'autocomplete' => 'off'])
                                !!}
                            </div>
                            <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('last_name') }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3 ">Ap. Materno: </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                                {!! Form::text('mother_last_name', old('mother_last_name', $beneficiary->mother_last_name), [
                                    'class' => 'form-control',
                                    'placeholder' => 'Ap. Materno',
                                    'autocomplete' => 'off'])
                                !!}
                            </div>
                            <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('mother_last_name') }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3  label_required">Parentesco: </label>
                        <div class="col-lg-9">
                            {!! Form::text('relationship', old('relationship', $beneficiary->relationship), [
                                'class' => 'form-control',
                                'placeholder' => 'Parentesco',
                                'autocomplete' => 'off'])
                            !!}
                            <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('relationship') }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3 ">Documento de Identidad: </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon">C.I.</span>
                                {!! Form::text('dni', old('dni', $beneficiary->dni), [
                                    'class' => 'form-control',
                                    'placeholder' => 'Documento de Identidad',
                                    'autocomplete' => 'off'])
                                !!}
                            </div>
                            <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('dni') }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Extensión: </label>
                        <div class="col-lg-9">
                            {!! SelectField::input('extension', $data['cities']['CI']->toArray(), [
                                'class' => 'select-search'],
                                old('extension', $beneficiary->extension)) !!}
                            <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('extension') }}</label>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Guardar <i class="icon-floppy-disk position-right"></i></button>
                    </div>

                {!! Form::close() !!}
            </div>

            <!-- /horizotal form -->
        </div>
    </div>
@endsection