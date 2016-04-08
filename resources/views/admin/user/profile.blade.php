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
                <small class="display-block">Editar Perfil</small>
            </h5>
            <div class="heading-elements">

            </div>
        </div>

        @include('admin.partials.message')

        <div class="panel-body">

            {!! Form::open(array('route' => 'update_profile', 'name' => 'EditForm', 'id' => 'EditForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Tipo de usuario: </label>
                    <div class="col-lg-10">
                        <strong>{{auth()->user()->type->name}}</strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Usuario: </label>
                    <div class="col-lg-10">
                        <strong>{{auth()->user()->username}}</strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Nombre Completo: <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required text" name="txtNombre" id="txtNnombre" autocomplete="off" value="{{$query->full_name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Telefono agencia:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control not-required number" name="txtTelefono" id="txtTelefono" autocomplete="off" value="{{$query->phone_number}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Correo electronico: <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required email" name="txtEmail" id="txtEmail" autocomplete="off" value="{{$query->email}}">
                    </div>
                </div>

            </fieldset>

            <div class="text-right">

                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>

                <a href="{{route('admin.home', ['nav'=>'begin'])}}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>

                <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(e){
            //VERIFICAMOS EL FORMULARIO
            $('#EditForm').submit(function(e){
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
                    $("#"+_id+":last").after('<span class="validation-error-label">'+err+'</span>');
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
                if($(element).hasClass('email') === true){
                    regex = /^([a-z]+[a-z0-9._-]*)@{1}([a-z0-9\.]{2,})\.([a-z]{2,3})$/;
                    err = 'Email invalido';
                }else if($(element).hasClass('text') === true){
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