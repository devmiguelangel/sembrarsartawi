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
                    <li class="active">Solicitud de aprobación a caso facultativo</li>
                </ul>
            </div>

        </div>
    </div>
@endsection

@section('content')
    {!! Form::open(['route' => ['de.fa.request.store',  'rp_id' => $rp_id, 'header_id' => encode($header->id)], 'method' => 'put', 'class' => 'form-horizontal']) !!}
        {!! Form::textArea('facultative_observation', old('facultative_observation', strip_tags($header->facultative_observation)), [
                'size' => '4x4',
            'class' => 'form-control',
            'placeholder' => 'Observación del Caso Facultativo',
            'autocomplete' => 'off'])
        !!}

        <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('facultative_observation') }}</label>

        <div class="text-right">
            <a href="{{ route('de.edit', ['rp_id' => $rp_id, 'header_id' => encode($header->id)]) }}" class="btn border-slate text-slate-800 btn-flat">Cancelar</a>

            {!! Form::button('Enviar Solicitud <i class="icon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}
@endsection
