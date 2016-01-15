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
            <h5 class="panel-title">Formulario agregar pregunta</h5>
            <div class="heading-elements">
                <!--
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
                -->
            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'create_add_question', 'name' => 'QuestCreateForm', 'id' => 'QuestCreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer</label>
                        <div class="col-lg-10">
                            <strong>{{$query->retailer}}</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Producto</label>
                        <div class="col-lg-10">
                            <strong>{{$query->product}}</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Pregunta <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            @if(count($question)>0)
                                <select name="id_question" id="id_question" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($question as $data)
                                        <option value="{{$data->id}}">{{$data->question}}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-info alert-styled-left alert-bordered">
                                    <span class="text-semibold">Alert</span> No existe ninguna pregunta, ingrese una nueva pregunta.
                                    <br>
                                    <a href="{{route('admin.questions.list', ['nav'=>'question', 'action'=>'list'])}}">Agregar una pregunta</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Respuesta esperada <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="response" id="response" class="form-control">
                                <option value="0">Seleccione</option>
                                <option value="1">SI</option>
                                <option value="2">NO</option>
                            </select>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    @if(count($question)>0)
                        <button type="submit" class="btn btn-primary">
                            Guardar <i class="icon-arrow-right14 position-right"></i>
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary" disabled>
                            Guardar <i class="icon-arrow-right14 position-right"></i>
                        </button>
                    @endif
                     <a href="{{route('admin.de.addquestion.list', ['nav'=>'addquestion', 'action'=>'list', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-primary">
                         Cancelar <i class="icon-arrow-right14 position-right"></i>
                     </a>
                    <input type="hidden" name="id_retailer_product" id="id_retailer_product" value="{{$id_retailer_product}}">
                </div>
            {!!Form::close()!!}
        </div>
    </div>
@endsection