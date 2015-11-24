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
                            <span class="form-wizard-count">8</span>
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
                    <div class="modal-header bg-primary">
                        <div class="panel-heading">
                            <h6 class="modal-title">Información del TITULAR</h6>
                        </div>
                    </div>
                    <div class="panel panel-body border-top-success">
                        <div class="panel-heading">
                            <!--<h5 class="panel-title">Infomración del TITULAR</h5>-->
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--<hr>-->
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Nombres: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->first_name }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Ap. Paterno: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->last_name }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Ap. Materno: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->mother_last_name }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Ap. de casada: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->married_name }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Estado Civil: </strong>
                                </div>
                                <div class="col-lg-7">
                                    @foreach($data['civil_status'] as $civil_status)
                                        @if($civil_status['id'] === $detail->client->civil_status)
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
                                        @if($document_type['id'] === $detail->client->document_type)
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
                                    {{ $detail->client->dni }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Complemento: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->complement }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Ext. Documento de identidad: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->extension }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>País: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->country }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Fecha de nacimiento: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ dateToFormat($detail->client->birthdate) }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Lugar de nacimiento: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->birth_place }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Lugar de residencia: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ ucwords(str_replace('-', ' ', $detail->client->place_residence)) }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Localidad: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->locality }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Dirección: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->home_address }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Ocupación (CAEDEC): </strong>
                                </div>
                                <div class="col-lg-7">
                                    @foreach($data['activities'] as $activity)
                                        @if($activity['id'] === $detail->client->ad_activity_id)
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
                                    {{ $detail->client->occupation_description }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Telefono 1: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->phone_number_home }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Telefono 2: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->phone_number_mobile }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Telef. Oficina: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->phone_number_office }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Correo electónico: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->email }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Peso: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->weight }} kg.
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Estatura: </strong>
                                </div>
                                <div class="col-lg-7">
                                    {{ $detail->client->height }} (cm).
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <strong>Género: </strong>
                                </div>
                                <div class="col-lg-7">
                                    @foreach($data['gender'] as $gender)
                                        @if($gender['id'] === $detail->client->gender)
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
                    <div class="modal-header bg-primary">
                        <div class="panel-heading">
                            <h6 class="modal-title">Cuestionario de Salud</h6>
                        </div>
                    </div>
                    <div class="panel panel-body border-top-success">
                        <!--
                        <div class="panel-heading modal-header bg-success">
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
                        -->
                        <div class="panel-heading">
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <strong>¿Ha padecido o padece cualquier enfermedad?</strong>
                                </div>
                                <div class="col-lg-2">
                                    Si
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <strong>¿Tiene algún defecto físico o congénito?</strong>
                                </div>
                                <div class="col-lg-2">
                                    No
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <strong>¿Le han detectado algún tumor o efectuado alguna prueba para descartar cáncer?</strong>
                                </div>
                                <div class="col-lg-2">
                                    No
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <strong>¿Ha sido sometido o le recomendaron alguna operación quirúrgica?</strong>
                                </div>
                                <div class="col-lg-2">
                                    Si
                                </div>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    Comentario de cuestionario, es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.
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
                                        <select name="mano_utilizada" class="select-search">
                                            <option value="">Seleccione</option>
                                            <option value="DE">Derecha</option>
                                            <option value="IZ">Izquierda</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label ">Avenida o Calle: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        <select name="avenida_calle" class="select-search">
                                            <option value="">Seleccione</option>
                                            <option value="AV">Avenida</option>
                                            <option value="CA">Calle</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Forma de pago: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-list-unordered"></i></span>
                                        <select required="required" name="forma_pgo" class="select-search">
                                            <option value="">Seleccione</option>
                                            <option value="1">Plan al contado</option>
                                            <option value="2">Debito Automatico</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Periodicidad: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-list-unordered"></i></span>
                                        <select required="required" name="periodicidad" class="select-search">
                                            <option value="">Seleccione</option>
                                            <option value="1">Pago Anual</option>
                                            <option value="2">Pago Mensual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Núero de cuenta1: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">Nro</span>
                                        <input name="numero_cuenta" required="required" type="text" class="form-control ui-wizard-content" placeholder="Número de cuenta1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Núero de cuenta2: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">Nro</span>
                                        <input name="numero_cuenta2" type="text" class="form-control ui-wizard-content" placeholder="Número de cuenta2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Tarjeta de Crédito: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-piggy-bank"></i></span>
                                        <input name="tarjeta_credito" required="required" type="text" class="form-control ui-wizard-content" placeholder="Tarjeta de Crédito">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Plan: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-list-unordered"></i></span>
                                        <select required="required" name="plan" class="select-search">
                                            <option value="">Seleccione</option>
                                            <option value="1">Plan A</option>
                                            <option value="2">Plan B</option>
                                            <option value="2">Plan C</option>
                                            <option value="2">Plan D</option>
                                        </select>
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
                                        <input name="numero_domicilio" required="required" type="text" class="form-control ui-wizard-content" placeholder="Número de domicilio">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Dirección laboral: </label>
                                <div class="col-lg-9">
                                    <textarea name="direccion" required="required" rows="4" cols="4" placeholder="Dirección laboral" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Guardar <i class="icon-floppy-disk position-right"></i></button>
                        </div>
                        <hr />
                        <div class="col-xs-12 col-md-6">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="modal-header bg-success">
                                    <h6 class="modal-title">Plan - D </h6>
                                </div>
                                <div class="panel panel-body border-top-primary text-center">
                                    <p class="text-muted content-group-sm">
                                        Muerte por cualquier causa Bs. 69,000<br>
                                        Invalidez Total y Permanente por enfermedad o accidente Bs. 69,000<br>

                                    </p>
                                    <div class="col-md-12">
                                        <p>Sepelio Bs 3,500<br>
                                            Prima Anual Bs. 1.032,00<br>
                                            Prima Mensual Bs. 86,00 <br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection