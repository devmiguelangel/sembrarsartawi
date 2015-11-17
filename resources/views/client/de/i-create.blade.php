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
                            <span class="form-wizard-count">5</span>
                            Emisión de Póliza de Desgravamen
                            <small class="display-block">Emisión de Póliza</small>
                        </span>
                        <span class="col-md-1">
                            <button style="float: left;" type="button" class="btn btn-rounded btn-default text-right" data-popup="tooltip" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                                <i class="icon-question7"></i> Producto
                            </button>
                        </span>
                    </h6>
                </div>
                <br />
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-body border-top-success">
                        <div class="panel-heading">
                            <h5 class="panel-title">Infomración del TITULAR</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Nombres: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->first_name }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Ap. Paterno: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->last_name }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Ap. Materno: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->mother_last_name }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Ap. de casada: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->married_name }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Estado Civil: </strong>
                                </div>
                                <div class="col-lg-7">
                                    @foreach($data['civil_status'] as $civil_status)
                                        @if($civil_status['id'] === $client->civil_status)
                                            {{ $civil_status['name'] }}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Tipo de documento:</strong>
                                </div>
                                <div class="col-lg-7">
                                    @foreach($data['document_type'] as $document_type)
                                        @if($document_type['id'] === $client->document_type)
                                            {{ $document_type['name'] }}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Documento de identidad: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->dni }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Complemento: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->complement }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Ext. Documento de identidad: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->extension }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>País: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->country }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Fecha de nacimiento: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ dateToFormat($client->birthdate) }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Lugar de nacimiento: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->birth_place }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Lugar de residencia: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ ucwords(str_replace('-', ' ', $client->place_residence)) }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Localidad: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->locality }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Dirección: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->home_address }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Ocupación (CAEDEC): </strong>
                                </div>
                                <div class="col-lg-7">
                                    @foreach($data['activities'] as $activity)
                                        @if($activity['id'] === $client->ad_activity_id)
                                            {{ $activity['name'] }}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Descripción ocupación: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->occupation_description }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Telefono 1: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->phone_number_home }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Telefono 2: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->phone_number_mobile }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Telef. Oficina: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->phone_number_office }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Correo electónico: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->email }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Peso: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->weight }} kg.
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Estatura: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $client->height }} (cm).
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Género: </strong>
                                </div>
                                <div class="col-lg-7">
                                    @foreach($data['gender'] as $gender)
                                        @if($gender['id'] === $client->gender)
                                            {{ $gender['name'] }}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            {{--<div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Monto Banca Comunal: </strong>
                                </div>
                                <div class="col-lg-7">
                                    Los Andes de America
                                </div>
                            </div>--}}
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Participación %: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->percentage_credit }} %
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-body border-top-success">
                        <div class="panel-heading">
                            <h5 class="panel-title">Cuestionario de Salud</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="col-xs-12 col-md-12">
                            @foreach(json_decode($detail->response->response) as $key => $response)
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <div class="col-lg-10">
                                        <strong>{{ $key }}. {{ $response->question }}</strong>
                                    </div>
                                    <div class="col-lg-2">
                                        {{ $response->response == 1 ? 'SI' : 'NO' }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="clearfix">&nbsp;</div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    {{ $detail->response->observation }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <form class="form-horizontal form-validate-jquery" action="#">
                    <div class="panel-body ">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Mano utilizada para escribir y/o firmar: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        {!! SelectField::input('hand', $data['hands']->toArray(), [
                                            'class' => 'select-search'],
                                            old('hand', $client->hand))
                                        !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label ">Avenida o Calle: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        {!! SelectField::input('avenue_street', $data['avenue_street']->toArray(), [
                                            'class' => 'select-search'],
                                            old('avenue_street', $client->avenue_street))
                                        !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label label_required col-lg-3">Número de domicilio: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">Nro.</span>
                                        {!! Form::text('home_number', old('home_number', $client->home_number), [
                                            'class' => 'form-control ui-wizard-content',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'Número de domicilio'])
                                        !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Dirección laboral: </label>
                                <div class="col-lg-9">
                                    {!! Form::textarea('business_address', old('business_address', $client->business_address), [
                                        'size' => '4x4',
                                        'class' => 'form-control',
                                        'placeholder' => 'Dirección laboral',
                                        'autocomplete' => 'off'])
                                    !!}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Guardar <i class="icon-floppy-disk position-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection