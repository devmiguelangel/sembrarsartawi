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
                    <i class="icon-pencil6"></i>
                </span>
                Formulario
                <small class="display-block">Nuevo registro </small>
            </h5>
            <div class="heading-elements">
                <!--
                <ul class="icons-list">

                    <li><a data-action="reload"></a></li>

                </ul>
                -->
            </div>
        </div>

        <div class="panel-body">
            {!! Form::open(array('route' => 'new_parameter_vi', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Facturación <span class="text-danger">*</span></label>
                    <label class="radio-inline">
                        <input type="radio" name="fact" class="styled required" value="1">SI
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="fact" class="styled required" value="0">NO
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Certificado Provisional <span class="text-danger">*</span></label>
                    <label class="radio-inline">
                        <input type="radio" name="cert" class="styled required" value="1">SI
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="cert" class="styled required" value="0">NO
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Modalidad <span class="text-danger">*</span></label>
                    <label class="radio-inline">
                        <input type="radio" name="moda" class="styled required" value="1">SI
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="moda" class="styled required" value="0">NO
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Facultativo <span class="text-danger">*</span></label>
                    <label class="radio-inline">
                        <input type="radio" name="facu" class="styled required" value="1">SI
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="facu" class="styled required" value="0">NO
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Web Service <span class="text-danger">*</span></label>
                    <label class="radio-inline">
                        <input type="radio" name="webs" class="styled required" value="1">SI
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="webs" class="styled required" value="0">NO
                    </label>
                </div>
                <div class="form-group">
                    <div class="validation-error-label col-lg-10" id="error-radio"></div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{ route('admin.vi.parameters.list', ['nav'=>'vi', 'action'=>'list', 'id_retailer_product'=>$id_retailer_product]) }}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>
                <input type="hidden" name="id_retailer_product" value="{{$id_retailer_product}}">
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //VERIFICAMOS EL FORMULARIO
            $('#NewForm').submit(function(e){
                var sw = true;
                var err = 'Esta informacion es obligatoria';
                var age = new Array();
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

                }else{
                    e.preventDefault();
                }
            });

            //VALIDAMOS ELEMENTO
            function validateElement(element,err){
                var _value = $(element).prop('value');
                var _type = $(element).prop('type');
                var _name = $(element).prop('name');
                //alert(_name);
                if(_type=='select-one'){
                    if(_value==0){
                        addClassE(element,err);
                        return false;
                    }else{
                        removeClassE(element,err);
                        return true;
                    }
                }else if(_type=='radio'){
                    err = 'seleccionar los campos requeridos con (*)';
                    var rd_val = $("input[name=" + _name + "]:radio").is(':checked');
                    //alert(rd_val);
                    if(rd_val === false){
                        $('#error-radio').html(err);
                        return false;
                    }else{
                        $('#error-radio').html('');
                        return true;
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