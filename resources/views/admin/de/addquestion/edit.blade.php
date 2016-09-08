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

            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'update_add_question', 'name' => 'UpdateForm', 'id' => 'UpdateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Retailer</label>
                    <div class="col-lg-10">
                        <strong>{{$retailer->retailer}}</strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Producto</label>
                    <div class="col-lg-10">
                        <strong>{{$retailer->product}}</strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Pregunta <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        {{$query->question}}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Respuesta esperada <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <select name="response" id="response" class="form-control required">
                            <option value="0">Seleccione</option>
                            <option value="1"
                                @if((boolean)$query->response==true)
                                    selected
                                @endif
                            >SI</option>
                            <option value="2"
                                @if((boolean)$query->response==false)
                                    selected
                                @endif
                            >NO</option>
                        </select>
                    </div>
                </div>

                @if($query->type!=null)
                    @var $style=''
                @else
                    @var $style='display:none'
                @endif
                @var $parameter_qt = config('base.question_types')
                <div class="form-group">
                    <label class="control-label col-lg-2">Tipo</label>
                    <div class="col-lg-10">
                        <select name="type" id="type" class="form-control">
                            <option value="">Ninguno</option>
                            @foreach($parameter_qt as $key=>$data)
                                @if($query->type==$key)
                                    <option value="{{$key}}" selected>{{$data}}</option>
                                @else
                                    <option value="{{$key}}">{{$data}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($query->type!=null)
                    <div class="form-group" style="{{$style}}" id="content-radio-edit">
                        <label class="control-label col-lg-2">Habilitar especificar respuesta <span class="text-danger">*</span></label>
                        <label class="radio-inline">
                            @if((boolean)$query->response_text==true)
                                <input type="radio" name="rdq_edit" class="styled" checked="checked" value="1">SI
                            @else
                                <input type="radio" name="rdq_edit" class="styled" value="1">SI
                            @endif
                        </label>

                        <label class="radio-inline">
                            @if((boolean)$query->response_text==false)
                                <input type="radio" name="rdq_edit" class="styled" checked="checked" value="0">NO
                            @else
                                <input type="radio" name="rdq_edit" class="styled" value="0">NO
                            @endif
                        </label>
                    </div>
                @endif
                    <div class="form-group" id="content-radio-new">
                        <label class="control-label col-lg-2">Habilitar especificar respuesta <span class="text-danger">*</span></label>
                        <label class="radio-inline">
                            <input type="radio" name="rdq_new" class="styled" value="1" id="rdq_new">SI
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rdq_new" class="styled" value="0" id="rdq_new">NO
                        </label>
                    </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{route('admin.de.addquestion.list', ['nav'=>'addquestion', 'action'=>'list', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>
                <input type="hidden" name="id_retailer_product" id="id_retailer_product" value="{{$id_retailer_product}}">
                <input type="hidden" name="id_retailer_product_question" value="{{$id_retailer_product_question}}">
                <input type="hidden" name="type_db" id="type_db" value="{{$query->type}}">
                <input type="hidden" name="option_rd" id="option_rd" value="e">
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //OCULTAMOS LOS RADIO BUTTON
            $('#content-radio-new').fadeOut('fast');

            //SELECCIONAMOS TIPO CREDITO
            $('#type').change(function(){
                var type = $(this).prop('value');
                //alert(type);
                var _type_db = $('#type_db').prop('value');
                //alert(_type_db);
                if(type=='PMO'){
                    $('#content-radio-new').fadeIn('fast');
                    $('input[name="rdq_new"]').removeClass('styled').addClass('styled required');
                    $('#option_rd').prop('value','n');
                }else{
                    if(_type_db=='PMO'){
                        $('#content-radio-edit').fadeOut('fast');
                        $('input[name="rdq_edit"]').removeClass('styled required').addClass('styled');
                        $('#content-radio-new').fadeOut('fast');
                        $('input[name="rdq_new"]').removeClass('styled required').addClass('styled');
                    }else{
                        $('#content-radio-new').fadeOut('fast');
                        $('input[name="rdq_new"]').removeClass('styled required').addClass('styled');
                    }
                }
            });

            //VERIFICAMOS EL FORMULARIO
            $('#UpdateForm').submit(function(e){
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
            function validateElement(element,err){
                var _value = $(element).prop('value');
                var _type = $(element).prop('type');
                var _name = $(element).prop('name');

                if(_type=='select-one'){
                    if(_value==0){
                        addClassE(element,err);
                        return false;
                    }else{
                        removeClassE(element,err);
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