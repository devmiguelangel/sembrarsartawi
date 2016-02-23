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
            <!--
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
            -->
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'new_file_form', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Titulo <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required text" name="txtTitulo" id="txtTitulo" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Archivo <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="file" class="file-styled required" name="txtFile" id="txtFile">
                        El tamaño máximo del archivo es de 2Mb, el formato del archivo a subir debe ser [PDF].
                    </div>
                    <div>
                        @if($errors)
                            {{ $errors->first('txtFile')}}
                        @endif
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>

                <a href="{{route('admin.formulario.list', ['nav'=>'form', 'action'=>'list', 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product])}}" class="btn btn-primary">
                    Cancelar <i class="icon-arrow-right14 position-right"></i>
                </a>
                <input type="hidden" name="id_retailer_products" value="{{$id_retailer_products}}">
                <input type="hidden" name="code_product" value="{{$code_product}}">
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#txtFile").change(function() {
                var file = this.files[0];
                var type_file = file.type;
                var size_file = file.size;
                if(size_file<=2097152){
                    if($("#txtFile + .validation-error-label").length) {
                        $("#txtFile + .validation-error-label").remove();
                    }
                    $('button[type="submit"]').prop('disabled', false);
                }else{
                    if(!$("#txtFile + .validation-error-label").length) {
                        $("#txtFile:last").after('<label class="validation-error-label">El tamaño del archivo sobrepasa los 2Mb</label>');
                    }
                    $('button[type="submit"]').prop('disabled', true);
                }
            });

            //VERIFICAMOS EL FORMULARIO
            $('#NewForm').submit(function(e){
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
                if(_type=='select-one'){
                    if(_value==0){
                        addClassE(element,err);
                        return false;
                    }else{
                        removeClassE(element,err);
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
                    regex = /^[a-zA-ZáÁéÉíÍóÓúÚñÑüÜ\s\.\-\()]*$/;
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