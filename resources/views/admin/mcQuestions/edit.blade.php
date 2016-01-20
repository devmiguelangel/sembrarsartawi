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
        <h5 class="panel-title"><i class="icon-plus2"></i> Modificación {{ $entity->question }}</h5>
        <hr />
    </div>
    <div class="panel-body">
        {!! Form::open(array('route' => ['update_mc_questions','id'=> $id], 'name' => 'Form', 'id' => 'mc_questions', 'method'=>'post', 'class'=>'form-horizontal form-validate-jquery')) !!}
        <fieldset class="content-group">
            <div class="form-group">
                <label class="control-label col-lg-2 label_required">Pregunta</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-text-width"></i></span>
                        <input type="text" value="{{ $entity->question }}" placeholder="Pregunta" class="form-control" name="question" id="question" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label label_required">Tipo de campo: </label>
                <div class="col-lg-5">
                    <select name="type" class="form-control" id="type" required="required">
                        <option value="">Seleccione</option>
                        @foreach($type as $type_campo)
                            @if($entity->type == $type_campo['key'])
                                <option value="{{ $type_campo['key'] }}" selected>{{ $type_campo['value'] }}</option>
                            @else
                                <option value="{{ $type_campo['key'] }}">{{ $type_campo['value'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </fieldset>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">
                Guardar <i class="icon-floppy-disk position-right"></i>
            </button>
            <a href="{{ route('mcQuestionsList') }}" class="btn btn-danger">
                Cancelar <i class="icon-arrow-right14 position-right"></i>
            </a>
        </div>
        {!!Form::close()!!}

    </div>
</div>
@endsection