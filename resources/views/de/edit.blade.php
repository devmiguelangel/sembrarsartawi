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
                                        <span class="number">1</span> Datos del Prestamo
                                    </a>
                                </li>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">2</span>Datos del Titular
                                    </a>
                                </li>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">2</span>Resultado Cotización
                                    </a>
                                </li>
                                <li class="current">
                                    <a href="#">
                                        <span class="current-info audible">current step: </span>
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
                    <button style="float: right;" type="button" class="btn btn-rounded btn-default text-right" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                        <i class="icon-question7"></i> Producto
                    </button>
                </div>
                <div class="clearfix"></div>

                @if(session('success_header'))
                    <script>
                        $(function(){messageAction('succes',"{{ session('success_header') }}");});
                    </script>
                @endif

                @if(session('error_header'))
                    <script>
                        $(function(){messageAction('error',"{{ session('error_header') }}");});
                    </script>
                @endif

                @if(is_null($header))
                    <div class="alert bg-danger alert-styled-right">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">La Cotización no existe</span>.
                    </div>
                @endif

                @if(session('error_client'))
                    <script>
                        $(function(){messageAction('error',"{{ session('error_client') }}");});
                    </script>
                @endif

                @if(session('success_client'))
                    <script>
                        $(function(){messageAction('succes',"{{ session('success_client') }}");});
                    </script>
                @endif

                @if(session('error_beneficiary'))
                    <script>
                        $(function(){messageAction('error',"{{ session('error_beneficiary') }}");});
                    </script>
                @endif

                @if(session('success_beneficiary'))
                    <script>
                        $(function(){messageAction('succes',"{{ session('success_beneficiary') }}");});
                    </script>
                @endif

                @if(session('error_detail'))
                    <script>
                        $(function(){messageAction('error',"{{ session('error_detail') }}");});
                    </script>
                @endif

                @if(session('success_detail'))                    
                    <script>
                        $(function(){messageAction('succes',"{{ session('success_detail') }}");});
                    </script>
                @endif

                @if(! is_null($header))
                    @if($header->facultative)
                        <div class="alert bg-warning alert-styled-right">
                            <span class="text-semibold">
                                Nota: Se deshabilitó el boton "Emitir" por las siguientes razones: <br>
                            </span>
                            @foreach($header->details as $detail)
                                @if($detail->facultative instanceof \Sibas\Entities\De\Facultative)
                                    {!! $detail->facultative->reason !!}
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <table class="table datatable-basic2">
                        <thead>
                        <tr>
                            <th>Titular</th>
                            <th>C.I.</th>
                            <th>Nombres y Apellidos</th>
                            <th>Fecha Nacimiento</th>
                            <th>Departamento</th>
                            <th>% Credito</th>
                            <th>Beneficiarios</th>
                            <th>Saldo Deudor</th>
                            <th class="text-center">Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($header->details as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="#">{{ $detail->client->dni }} {{ $detail->client->extension }}</a></td>
                                <td>{{ $detail->client->full_name }}</td>
                                <td>{{ dateToFormat($detail->client->birthdate) }}</td>
                                <td>{{ $detail->client->birth_place }}</td>
                                <td>{{ $detail->percentage_credit }} %</td>
                                <td>
                                    @if($detail->completed)
                                        <a href="{{ route('de.beneficiary.edit', [
                                                        'rp_id'     => $rp_id,
                                                        'header_id' => $header_id,
                                                        'detail_id' => encode($detail->id)]) }}" title="Completado">
                                            <span class="label label-success">Completado</span>
                                        </a>
                                    @else
                                    <a href="{{ route('de.beneficiary.create', [
                                                        'rp_id'     => $rp_id,
                                                        'header_id' => $header_id,
                                                        'detail_id' => encode($detail->id)]) }}" title="Pendiente">
                                        <span class="label label-danger">Pendiente</span>
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if($detail->cumulus > 0)
                                        <a href="{{ route('de.detail.balance.edit', ['rp_id' => $rp_id,
                                                        'header_id' => $header_id,
                                                        'detail_id' => encode($detail->id)]) }}" title="Completado">
                                            <span class="label label-success">Completado</span>
                                        </a>
                                    @else
                                        <a href="{{ route('de.detail.balance.edit', ['rp_id' => $rp_id,
                                                        'header_id' => $header_id,
                                                        'detail_id' => encode($detail->id)]) }}" title="Pendiente">
                                            <span class="label label-danger">Pendiente</span>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{ route('de.detail.i.edit', [
                                                    'rp_id'     => $rp_id,
                                                    'header_id' => $header_id,
                                                    'detail_id' => encode($detail->id),
                                                    'ref'       => 'ise']) }}">
                                                        <i class="icon-pencil3"></i> Editar datos del cliente
                                                    </a>
                                                </li>
                                                <li>
                                                    @if(is_null($detail->beneficiary))
                                                        <a href="{{ route('de.beneficiary.create', [
                                                        'rp_id'     => $rp_id,
                                                        'header_id' => $header_id,
                                                        'detail_id' => encode($detail->id)]) }}">
                                                            <i class="icon-plus2"></i> Registrar Beneficiarios
                                                        </a>
                                                    @else
                                                        <a href="{{ route('de.beneficiary.edit', [
                                                        'rp_id'     => $rp_id,
                                                        'header_id' => $header_id,
                                                        'detail_id' => encode($detail->id)]) }}">
                                                            <i class="icon-plus2"></i> Editar Beneficiarios
                                                        </a>
                                                    @endif
                                                </li>
                                                <li>
                                                    <a href="{{ route('de.detail.balance.edit', ['rp_id' => $rp_id,
                                                    'header_id' => $header_id,
                                                    'detail_id' => encode($detail->id)]) }}">
                                                        <i class="icon-plus2"></i>
                                                        @if($detail->cumulus > 0)
                                                            Editar Saldo deudor
                                                        @else
                                                            Registrar Saldo deudor
                                                        @endif
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="modal-header bg-primary title">
                        <div class="panel-heading">
                            <h6 class="modal-title">Datos del Crédito Solicitado</h6>
                        </div>
                    </div>

                    {!! Form::open(['route' => ['de.update',  'rp_id' => $rp_id, 'header_id' => $header_id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    <div class="panel-body ">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Tipo de Cobertura: </label>
                                <div class="col-lg-9">
                                    {!! SelectField::input('coverage', $data['coverages']->toArray(), [
                                        'class' => 'select-search'],
                                        old('coverage', $header->coverage->id))
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('coverage') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3  label_required">Monto Actual Solicitado: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-cash2"></i></span>
                                        {!! Form::text('amount_requested', old('amount_requested', $header->amount_requested), [
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'Monto Actual Solicitado',
                                            'readonly' => 'readonly'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('amount_requested') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label label_required">Moneda: </label>
                                <div class="col-lg-9">
                                    {!! SelectField::input('currency', $data['currencies']->toArray(), [
                                        'class' => 'bootstrap-select'],
                                        old('currency', $header->currency))
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('currency') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Plazo del Credito: </label>
                                <div class="col-lg-3">
                                    {!! Form::text('term', old('term', $header->term), [
                                        'class' => 'form-control ui-wizard-content',
                                        'autocomplete' => 'off',
                                        'placeholder' => 'Plazo del Credito',
                                        'readonly' => 'readonly'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('term') }}</label>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-sort-time-asc"></i></span>
                                        {!! SelectField::input('type_term', $data['term_types']->toArray(), [
                                            'class' => 'select-search'], old('type_term', $header->type_term))
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('type_term') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label col-lg-3">Número de Operación: </label>
                                <div class="col-lg-9">
                                    {!! Form::text('operation_number', old('operation_number', $header->operation_number), [
                                        'class' => 'form-control ui-wizard-content',
                                        'autocomplete' => 'off',
                                        'placeholder' => 'Número de Operación'])
                                    !!}
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('operation_number') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 label_required">Número de Póliza: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">Nro</span>
                                        {!! Form::text('policy_number', old('policy_number', $header->policy_number), [
                                            'class' => 'form-control ui-wizard-content',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'Nombre de Póliza'])
                                        !!}
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('policy_number') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            @if($header->type === 'Q')
                                @if($header->completed && $header->cumulus > 0)
                                    {!! Form::button('Guardar <i class="icon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                @endif
                            @elseif($header->type === 'I')
                                @if(! $header->facultative)
                                    <a href="{{ route('de.issue', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}" class="btn btn-primary">
                                        Emitir <i class="icon-floppy-disk position-right"></i>
                                    </a>
                                @else
                                    @if($header->facultative && ! $header->approved)
                                        <a href="{{ route('de.fa.request.create', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}" class="btn btn-warning">
                                            Solicitar aprobación de la Compañia <i class="icon-warning position-right"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('home', []) }}" class="btn btn-info">
                                            Solicitud enviada (Cerrar) <i class="icon-warning position-right"></i>
                                        </a>
                                    @endif
                                @endif
                            @endif

                        </div>
                    </div>
                    {!! Form::close() !!}
                @endif

            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection