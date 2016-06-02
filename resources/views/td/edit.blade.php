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
                    <li><a href="">Resultado Cotizaci&oacute;n</a></li>
                    <li class="active">Emici&oacute;n de P&oacute;liza Seguro de Multiriesgo</li>
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
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">3</span> Resultado Cotización
                                    </a>
                                </li>
                                <li class="current">
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

                @if(session('success_client'))
                    <script>
                        $(function () {
                            messageAction('succes', "{{ session('success_client') }}");
                        });
                    </script>
                @endif

                @if(session('error_header'))
                    <div class="alert bg-danger alert-styled-right">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span>
                        </button>
                        <span class="text-semibold">{{ session('error_header') }}</span>.
                    </div>
                @endif

                <div class="panel-body ">
                    <div class="col-md-10 col-md-offset-1">
                        @if ($header->type === 'I')
                            <div class="page-header" style="padding: 5px;">
                                <h2>Póliza {{ $header->prefix }}-{{ $header->issue_number }}</h2>
                            </div>

                            @if($header->facultative)
                                <div class="alert bg-warning alert-styled-right">
                            <span class="text-semibold">
                                Nota: Se deshabilitó el boton "Emitir" por las siguientes razones: <br>
                            </span>
                                    {!! $header->facultative_observation !!}
                                    <span class="text-semibold">
                                <br>
                                Por lo tanto debe solicitar aprobación de la Compañia de Seguros
                            </span>
                                </div>
                            @endif
                        @endif
                        <div class="modal-header bg-primary recuadro">
                            <div class="panel-heading">
                                <h6 class="modal-title">Datos del Titular </h6>
                            </div>
                        </div>
                        <div class="panel panel-body border-top-success">
                            <div class="col-md-12">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <div class="col-lg-5"><strong>Apellido Paterno: </strong></div>
                                        <div class="col-lg-7">{{ $header->client->last_name }}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <div class="col-lg-5"><strong>Apellido Materno: </strong></div>
                                        <div class="col-lg-7">{{ $header->client->mother_last_name }}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <div class="col-lg-5"><strong>Nombres: </strong></div>
                                        <div class="col-lg-7">{{ $header->client->first_name }}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <a class="btn btn-default pull-right" href="{{ route('td.client.i.edit', [

                                    'rp_id'     => $rp_id,
                                    'header_id' => $header_id,
                                    'client_id' => encode($header->client->id),
                                     isset($_GET['idf']) ? 'idf=' . e($_GET['idf']) : null
                                ]) }}">
                                <span class="label label-success">Completado</span>
                                Editar <i class="icon-pencil position-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <div class="modal-header bg-primary recuadro">
                            <div class="panel-heading">
                                <h6 class="modal-title">Datos del Inmueble</h6>
                            </div>
                        </div>
                        <div class="panel panel-body border-top-success">
                            <a class="list_content"
                               onclick="listInsured('{{ route('td.list.insured',['rp_id'=>$rp_id,'header_id'=>$header_id])}}', 'GET', '{{ $header_id }}');"></a>
                            <div class="col-xs-12 col-md-12" id="content_insured"></div>
                        </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <div class="modal-header bg-primary recuadro">
                            <div class="panel-heading">
                                <h6 class="modal-title">Datos Generales</h6>
                            </div>
                        </div>
                        <div class="panel panel-body border-top-success">
                            <div class="col-md-12">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <div class="col-lg-5"><strong>Plazo Crédito: </strong></div>
                                        <div class="col-lg-7">{{ $header->term }} {{ $termTypes[$header->type_term] }}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <div class="col-lg-5"><strong>Inicio de Vigencia: </strong></div>
                                        <div class="col-lg-7">{{ date('Y-m-d',strtotime($header->validity_start)) }}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <div class="col-lg-5"><strong>Forma de Pago: </strong></div>
                                        <div class="col-lg-7">{{ $paymentMethods[$header->payment_method] }}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr/>
                            </div>
                            {!! Form::open(array('route' => ['td.update','rp_id' => $rp_id, 'header_id' => $header_id], 'method' => 'put', 'name' => 'Form', 'id' => 'issued_form', 'class'=>'form-horizontal form-validate-jquery')) !!}
                            <div class="col-md-12">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label label_required">Nro. de Póliza: </label>
                                        <div class="col-lg-9">
                                            {!! SelectField::input('policy_number', $policies->toArray(), [
                                                'class' => 'select2-choice',
                                                'required' => 'required',
                                                'id' => 'policy_number'],
                                                old('policy_number', $header->type === 'I'?$header->policy_number:''))
                                            !!}
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label label_required">Número Operación: </label>
                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <span class="input-group-addon">Nro</span>
                                                {!! Form::text('operation_number', old('operation_number', 
                                                $header->type === 'I'?$header->operation_number:''
                                                ), [
                                                    'class'        => 'form-control ui-wizard-content',
                                                    'id' => 'operation_number',
                                                    'autocomplete' => 'off',
                                                    'required' => 'required',
                                                    'placeholder'  => 'Número Operación'])
                                                !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label label_required">Facturar a: </label>
                                        <div class="col-lg-9">
                                            {!! Form::text('bill_name', old('bill_name', $header->client->full_name), [
                                                'class'        => 'form-control ui-wizard-content',
                                                'id' => 'bill_name',
                                                'autocomplete' => 'off',
                                                'required' => 'required',
                                                'placeholder'  => 'Facturar a'])
                                            !!}
                                            <small>Datos de <strong>Facturación</strong>.</small>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label label_required">NIT: </label>
                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <span class="input-group-addon">Nro</span>
                                                {!! Form::text('bill_dni', old('bill_dni', $header->client->dni), [
                                                    'class'        => 'form-control ui-wizard-content',
                                                    'id' => 'bill_dni',
                                                    'autocomplete' => 'off',
                                                    'required' => 'required',
                                                    'placeholder'  => 'NIT'])
                                                !!}
                                            </div>
                                            <small>Datos de <strong>Facturación</strong>.</small>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="text-right">
                                @if($header->type === 'Q')
                                    <button type="submit" class="btn btn-primary">Guardar <i
                                                class="glyphicon glyphicon-floppy-disk position-right"></i>
                                    </button>
                                @elseif($header->type === 'I')
                                    @if(! $header->facultative)
                                        <a href="{{ route('home', []) }}" class="btn btn-info">
                                            Guardar y Cerrar <i class="icon-floppy-disk position-right"></i>
                                        </a>

                                        <a href="{{ route('td.issue', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}"
                                           class="btn btn-primary">
                                            Emitir <i class="icon-play position-right"></i>
                                        </a>
                                    @else
                                        @if($header->facultative && ! $header->approved && ! $header->facultative_sent && ! isset($_GET['idf']))

                                            <a href="#"
                                               onclick="returnContent('{{ route('td.fa.request.create',['rp_id'=>$rp_id, 'header_id'=>$header_id, 'id_detail'=>0])}}', 'GET');$('.modal-title').html('Solicitar aprobación de la Compañia')"
                                               data-toggle="modal" data-target="#modal_general"
                                               class="btn btn-warning text-left">
                                                Solicitar aprobación de la Compañia <i
                                                        class="icon-warning position-right"></i>
                                            </a>
                                        @else
                                            @if (! isset($_GET['idf']))
                                                <a href="{{ route('home', []) }}" class="btn btn-info">
                                                    Solicitud enviada (Cerrar) <i
                                                            class="icon-warning position-right"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('home') }}"
                                                   class="btn border-slate text-slate-800 btn-flat">Cancelar</a>

                                                {!! Form::button('Solicitud enviada (Guardar y Cerrar) <i class="icon-warning position-right"></i>', [
                                                    'type'  => 'submit',
                                                    'class' => 'btn btn-primary'
                                                ]) !!}
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            </div>
                            {!!Form::close()!!}
                        </div>

                    </div>
                </div>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.list_content').click();
        });
    </script>
    <!-- modal -->
    @include('partials.modal')
            <!-- /modal -->
@endsection