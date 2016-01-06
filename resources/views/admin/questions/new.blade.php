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
        <!--
        <div class="panel-heading">
            <h5 class="panel-title">Crear pregunta</h5>
            <div class="heading-elements">
                <ul class="icons-list">

                    <li><a data-action="reload"></a></li>

                </ul>
            </div>
        </div>
        -->
        <div class="panel-body">

            {!! Form::open(array('route' => 'create_question', 'name' => 'QuestCreateForm', 'id' => 'QuestCreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Pregunta</label>
                        <div class="col-lg-10">
                            <textarea rows="5" cols="5" class="form-control" id="txtQuestion" name="txtQuestion"></textarea>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-arrow-right14 position-right"></i>
                    </button>
                    <a href="{{ route('admin.questions.list', ['nav'=>'question', 'action'=>'list']) }}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}

        </div>
    </div>
@endsection