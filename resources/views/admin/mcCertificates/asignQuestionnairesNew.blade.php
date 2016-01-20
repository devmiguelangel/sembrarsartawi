@extends('admin.layout')

@section('menu-user')
@include('admin.partials.menu-user')
@endsection

@section('menu-main')
@include('admin.partials.menu-main')
@endsection

@section('header')
@include('admin.partials.header')
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><i class="icon-plus2"></i> Asginacion de Questionarios - {{ $mcCertificates->name }}</h5>
        <hr />
    </div>
    <div class="panel-body">
        {!! Form::open(array('route' => 'create_mc_certificates_mc_questionnaires', 'name' => 'Form', 'id' => 'mc_certificate-questionnaires', 'method'=>'post', 'class'=>'form-horizontal form-validate-jquery')) !!}
        <fieldset class="content-group">
            
            <div class="form-group">
                <label class="control-label col-lg-2 label_required">Questionario</label>
                <div class="col-lg-5">
                    <select class="form-control" multiple="multiple" id="mc_questionnaire_id" name="mc_questionnaire_id[]" required="required">
                        @foreach($mcQuestionnaires as $questionnaries)
                        <option value="{{ $questionnaries->id }}">{{ $questionnaries->title }}</option>      
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="hidden" id="mc_certificate_id" name="mc_certificate_id" value="{{ $mcCertificates->id }}">
            <hr />
            <div class="form-group">
                <label class="radio-inline radio-right">
                    <input type="radio" value="1" checked="checked" name="active">
                    Activar
                </label>

                <label class="radio-inline radio-right">
                    <input type="radio" value="0" name="active">
                    Desactivar
                </label>
            </div>
        </fieldset>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">
                Guardar <i class="icon-floppy-disk position-right"></i>
            </button>
            <a href="{{ route('mcCertificatesList') }}" class="btn btn-danger">
                Cancelar <i class="icon-arrow-right14 position-right"></i>
            </a>
        </div>
        {!!Form::close()!!}
    </div>
</div>
@endsection