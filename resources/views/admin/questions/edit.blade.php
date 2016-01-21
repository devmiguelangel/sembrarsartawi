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
            <h5 class="form-wizard-title text-semibold" style="border-bottom: 0px;">
                <span class="form-wizard-count">
                    <i class="icon-pencil7"></i>
                </span>
                Formulario
                <small class="display-block">Editar registro </small>
            </h5>
            <div class="heading-elements">
                <!--<ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>-->
            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'update_question', 'name' => 'QuestUpdateForm', 'id' => 'QuestUpdateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Pregunta</label>
                        <div class="col-lg-10">
                            <textarea rows="5" cols="5" class="form-control" id="txtQuestion" name="txtQuestion">{{$query->question}}</textarea>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{ route('admin.questions.list', ['nav'=>'question', 'action'=>'list']) }}" class="btn btn-primary">
                        Cancelar <i class="icon-cross position-right"></i>
                    </a>
                    <input type="hidden" name="id_question" id="id_question" value="{{$query->id}}">
                </div>
            {!!Form::close()!!}

        </div>
    </div>
@endsection