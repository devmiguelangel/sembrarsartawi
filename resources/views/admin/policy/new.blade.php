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
                <small class="display-block">Nuevo registro</small>
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
        @if($code_product=='vi')
            @var $class_input='form-control required number'
            @var $class_radio = 'styled required'
            @var $hide = ''
        @else
            @var $class_input=''
            @var $class_radio=''
            @var $hide = 'display: none;'
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'create_policy', 'name' => 'CreateForm', 'id' => 'CreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Producto</label>
                    <div class="col-lg-10">
                        <strong>{{$query_prod->product}}</strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Numero de Póliza <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" name="txtNumPoliza" id="txtNumPoliza" value="" class="form-control required alphanumeric">
                    </div>
                </div>
                @if($code_product=='au' || $code_product=='td')
                    <div class="form-group">
                        <label class="control-label col-lg-2">Moneda <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="moneda" id="moneda" class="form-control required">
                                <option value="0">Seleccione</option>
                                <option value="BS">Bolivianos</option>
                                <option value="USD">Dolares</option>
                            </select>
                        </div>
                    </div>
                @endif
                <div class="form-group" style="{{$hide}}">
                    <label class="control-label col-lg-2">Póliza Final <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" name="txtEndPoliza" id="txtEndPoliza" value="" class="{{$class_input}}">
                    </div>
                </div>

                <div class="form-group" style="{{$hide}}">
                    <label class="control-label col-lg-2">Auto Incremento <span class="text-danger">*</span></label>
                    <label class="radio-inline">
                        <input type="radio" name="auto_inc" id="auto_inc" class="{{$class_radio}}" value="1">SI
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="auto_inc" id="auto_inc" class="{{$class_radio}}" value="0">NO
                    </label>
                    <div class="validation-error-label col-lg-10" id="error-increment"></div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Fecha Inicial <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            <input type="text" class="form-control pickadate-cobodate required" name="fechaini" id="fechaini" value="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Fecha Final <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            <input type="text" class="form-control pickadate-cobodate required" name="fechafin" id="fechafin" value="">
                        </div>
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{route('admin.policy.list', ['nav'=>'policy', 'action'=>'list', 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product])}}" class="btn btn-primary">
                    Cancelar <i class="icon-arrow-right14 position-right"></i>
                </a>
                <input type="hidden" name="id_retailer_products" id="id_retailer_products", value="{{$id_retailer_products}}">
                <input type="hidden" name="code_product" value="{{$code_product}}">
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#txtNumPoliza').keyup(function() {
                $(this).val($(this).val().toUpperCase());
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
                    var rd_val = $("input[name=" + _name + "]:radio").is(':checked');
                    //alert(rd_val);
                    if(rd_val === false){
                        $('#error-increment').html(err);
                        return false;
                    }else{
                        $('#error-increment').html('');
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
                }else if($(element).hasClass('alphanumeric') === true){
                    regex = /^([0-9A-Z\-])*$/;
                    err = 'Ingrese numeros y letras';
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