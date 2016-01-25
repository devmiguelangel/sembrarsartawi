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
        <h5 class="panel-title"><i class="icon-plus2"></i> Asginacion de Preguntas - {{ $mcQuestionnaires->title }}</h5>
        <hr />
    </div>
    <div class="panel-body">
        {!! Form::open(array('route' => 'create_asign_question', 'name' => 'Form', 'id' => 'mc_certificate_questionnaires_question', 'method'=>'post', 'class'=>'form-horizontal form-validate-jquery')) !!}
        <fieldset class="content-group">
            
            <div class="form-group">
                <label class="control-label col-lg-2 label_required">Preguntas</label>
                <div class="col-lg-5">
                    <select class="form-control" multiple="multiple" id="mc_question_id" name="mc_question_id[]" required="required">
                        @foreach($mcQuestions as $questions)
                        <option value="{{ $questions->id }}">{{ $questions->question }}</option>      
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="hidden" id="mc_certificate_questionnaire_id" name="mc_certificate_questionnaire_id" value="{{ $id_cert_quest }}">
            <input type="hidden" id="id_certificado" name="id_certificado" value="{{ $id_cert }}">
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
            <a href="{{ route('asignQuestionList',['id_cert'=>$id_cert]) }}" class="btn btn-danger">
                Cancelar <i class="icon-arrow-right14 position-right"></i>
            </a>
        </div>
        {!!Form::close()!!}
    </div>
</div>
@endsection