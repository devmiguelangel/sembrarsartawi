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
                            <span class="form-wizard-count">3</span>
                            Seguro de Desgravamen
                            <small class="display-block">Cuestionario</small>
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
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <strong>Titular: </strong>
                                    {{ $data['client']->full_name }}
                                </h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <hr />
                            <div class="panel-body">
                                {!! Form::open(['route' => ['de.question.store', 'rp_id' => $rp_id, 'header_id' => $header_id], 'method' => 'post', 'class' => '']) !!}
                                    {!! Form::hidden('header_id', $header_id) !!}
                                    {!! Form::hidden('client_id', $client_id) !!}
                                    {!! Form::hidden('rp_id', encrypt($rp_id)) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($data['questions'] as $question)
                                                <div class="form-group">
                                                    <div class="col-xs-12 col-md-10">
                                                        <label class="radio-inline text-semibold">
                                                            <strong>{{ $question['order'] }}</strong>.
                                                            {{ $question['question'] }}
                                                        </label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-2">
                                                        {!! Form::hidden('qs[' . $question['order'] . '][id]', $question['id']) !!}
                                                        {!! Form::hidden('qs[' . $question['order'] . '][question]', $question['question']) !!}
                                                        <label class="radio-inline radio-right">
                                                            {!! Form::radio('qs[' . $question['order'] . '][response]', '1', $question['check_yes'], ['class' => 'styled']) !!}
                                                            Si
                                                        </label>
                                                        <label class="radio-inline radio-right">
                                                            {!! Form::radio('qs[' . $question['order'] . '][response]', '0', $question['check_no'], ['class' => 'styled']) !!}
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        {!! Form::textarea('qs_observation', old('desc_occupation'), [
                                            'size' => '4x4',
                                            'class' => 'form-control',
                                            'placeholder' => 'Observación',
                                            'autocomplete' => 'off'])
                                        !!}
                                        {!! Form::hidden('qs_number', count($data['questions'])) !!}
                                    </div>
                                    <div class="text-right">
                                        {!! Form::button('Guardar <i class="icon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /horizotal form -->
            </div>
        </div>
    </div>
@endsection