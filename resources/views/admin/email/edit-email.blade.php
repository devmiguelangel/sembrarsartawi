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
                <small class="display-block">Editar registro </small>
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

        <div class="panel-body">

            {!! Form::open(array('route' => 'update_email', 'name' => 'EditForm', 'id' => 'EditForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Nombre completo <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" name="txtNombre" id="txtNombre" class="form-control required text" autocomplete="off" value="{{$query->name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Correo electronico <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" name="txtEmail" id="txtEmail" class="form-control required email" autocomplete="off" value="{{$query->email}}">
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{route('admin.email.list-email-product-retailer', ['nav'=>'email', 'action'=>'list_epr'])}}" class="btn btn-primary">
                    Cancelar <i class="icon-arrow-right14 position-right"></i>
                </a>
                <input type="hidden" name="ad_email_id" value="{{$ad_email_id}}">
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //VERIFICAMOS EL CORREO
            $('#txtEmail').keyup(function(e){
                var email = $(this).prop('value');
                if(email.match(/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.-][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/)){
                    $.get( "{{url('/')}}/admin/email/quest_email/"+email, function( data ) {
                        console.log(data);
                        if(data==1){

                            if($("#txtEmail + .validation-error-label").length) {
                                $("#txtEmail + .validation-error-label").remove();
                            }
                            $('button[type="submit"]').prop('disabled', true);
                            if(!$("#txtEmail + .validation-error-label").length) {
                                $("#txtEmail:last").after('<span class="validation-error-label">El correo electronico ya existe , ingrese otro correo</span>');
                            }
                        }else if(data==0){
                            $('button[type="submit"]').prop('disabled', false);
                            if($("#txtEmail + .validation-error-label").length) {
                                $("#txtEmail + .validation-error-label").remove();
                            }
                        }
                    });
                }else{
                    e.preventDefault();
                    if($("#txtEmail + .validation-error-label").length) {
                        $("#txtEmail + .validation-error-label").remove();
                    }
                    if(!$("#txtEmail + .validation-error-label").length) {
                        $("#txtEmail:last").after('<span class="validation-error-label">Email no valido</span>');
                    }
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
                    regex = /^[a-zA-ZáÁéÉíÍóÓúÚñÑüÜ\s]*$/;
                    err = 'Ingrese solo texto';
                }else if($(element).hasClass('email') === true){
                    regex = /^([a-z]+[a-z0-9._-]*)@{1}([a-z0-9\.]{2,})\.([a-z]{2,3})$/;
                    err = 'Email invalido';
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