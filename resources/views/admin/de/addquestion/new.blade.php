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
                <small class="display-block">Nuevo registro </small>
            </h5>
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
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'create_add_question', 'name' => 'CreateForm', 'id' => 'CreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
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
                        <label class="control-label col-lg-2">Agregar Pregunta <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            @if(count($question)>0)
                                <select multiple="multiple" name="addquestion[]" id="id_question" class="form-control required" data-popup="tooltip" title="Presione la tecla [Ctrl] para seleccionar mas opciones">
                                    @foreach($question as $data)
                                        <option value="{{$data->id}}">{{$data->question}}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-info alert-styled-left alert-bordered">
                                    <span class="text-semibold">Alert</span> No existe ninguna pregunta, ingrese una nueva pregunta.
                                </div>
                            @endif
                        </div>
                    </div>
                    @var $parameter_qt = config('base.question_types')
                    <div class="form-group">
                        <label class="control-label col-lg-2">Tipo</label>
                        <div class="col-lg-10">
                            <select name="type" id="type" class="form-control">
                                <option value="">Ninguno</option>
                                @foreach($parameter_qt as $key=>$data)
                                    <option value="{{$key}}">{{$data}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="content-radio">
                        <label class="control-label col-lg-2">Habilitar especificar respuesta <span class="text-danger">*</span></label>
                        <label class="radio-inline">
                            <input type="radio" name="response_question" class="styled" value="1" id="response_question">SI
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="response_question" class="styled" value="0" id="response_question">NO
                        </label>
                    </div>

                </fieldset>

                <div class="text-right">
                    @if(count($question)>0)
                        <button type="submit" class="btn btn-primary">
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary" disabled>
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @endif
                     <a href="{{route('admin.de.addquestion.list', ['nav'=>'addquestion', 'action'=>'list', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-primary">
                         Cancelar <i class="icon-cross position-right"></i>
                     </a>
                     @if(count($question)==0)
                        <a href="{{route('admin.questions.list', ['nav'=>'question', 'action'=>'list', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-primary">
                            Crear pregunta<i class="icon-pencil3 position-right"></i>
                        </a>
                     @endif
                    <input type="hidden" name="id_retailer_product" id="id_retailer_product" value="{{$id_retailer_product}}">
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#content-radio').fadeOut('fast');

            //SELECCIONAMOS TIPO CREDITO
            $('#type').change(function(){
                var type = $(this).prop('value');
                if(type=='PMO'){
                    $('#content-radio').fadeIn('fast');
                    $('input[name="response_question"]').removeClass('styled').addClass('styled required');
                }else{
                    $('#content-radio').fadeOut('fast');
                    $('input[name="response_question"]').removeClass('styled required').addClass('styled');
                }
            });

            //VERIFICAMOS EL FORMULARIO
            $('#CreateForm').submit(function(e){
                var sw = true;
                var err = 'Esta informacion es obligatoria';
                $(this).find('.required, .not-required').each(function(index, element) {
                    //alert(element.type+'='+element.value);
                    if($(this).hasClass('required') === true){
                        if(validateElement(element,err) === false){
                            sw = false;
                        }else if(validateElementType(element,err) === false){
                            sw = false;
                        }
                    }else if($(this).hasClass('not-required') === true){
                        removeClassE(element);
                        if(validateElementType(element,err) === false){
                            sw = false;
                        }
                    }
                });
                if(sw==true){
                    $('button[type="submit"]').prop('disabled', true);
                }else{
                    e.preventDefault();
                }
            });

            //VALIDAMOS ELEMENTO
            function validateElement(element,err) {
                var _value = $(element).prop('value');
                var _type = $(element).prop('type');
                var _name = $(element).prop('name');
                //alert(_type + ' ' + _value + ' ' + _name);
                if (_type == 'select-one') {
                    if (_value == 0) {
                        addClassE(element, err);
                        return false;
                    } else {
                        removeClassE(element, err);
                        return true;
                    }
                }else if(_type == 'radio'){

                    if($("input[name='"+_name+"']:radio").is(':checked')){
                        removeClassE(element,err);
                        return true;
                    }else{
                        addClassE(element,err);
                        return false;
                    }

                }else{
                    if(_value==''){
                        addClassE(element,err);
                        return false;
                    }else{
                        removeClassE(element,err);
                        return true;
                    }
                }
            }
            //ADICIONAMOS CLASE
            function addClassE(element,err){
                var _id = $(element).prop('id');
                var _type = $(element).prop('type');
                //$(element).addClass('error-text');
                if(!$("#"+_id+" + .validation-error-label").length) {
                    $("#"+_id+":last").after('<label class="validation-error-label">'+err+'</label>');
                }

            }
            //REMOVEMOS CLASE
            function removeClassE(element){
                var _id = $(element).prop('id');
                //$(element).removeClass('error-text');
                if($("#"+_id+" + .validation-error-label").length) {
                    $("#"+_id+" + .validation-error-label").remove();
                }
            }
            //VALIDAR TIPO DE ELEMENTO
            function validateElementType(element,err){
                var _value = $(element).prop('value');
                var regex = null;
                if($(element).hasClass('text') === true){
                    regex = /^[a-zA-ZáÁéÉíÍóÓúÚñÑüÜ\s]*$/;
                    err = 'Ingrese solo texto';
                }else if($(element).hasClass('number') === true){
                    regex = /^([0-9])*$/;
                    err = 'Ingrese solo numeros';
                }

                if(regex !== null){
                    if(!(regex.test(_value)) && _value.length !== 0){
                        addClassE(element,err);
                        $(element).prop('value', '');
                        return false;
                    }else{
                        removeClassE(element,err);
                        return true;
                    }
                }else{
                    return true;
                }
            }
        });
    </script>
@endsection