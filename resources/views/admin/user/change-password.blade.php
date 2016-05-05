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
            <h5 class="panel-title">Formulario cambiar contraseña</h5>
            <div class="heading-elements">

            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'change_pass', 'name' => 'userChangeForm', 'id' => 'userChangeForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Usuario</label>
                        <div class="col-lg-10" style="font-weight: bold;">
                            {{$user_find->full_name}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Contraseña actual</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control required" id="contrasenia_actual" name="contrasenia_actual">
                            <div id="err_pass_actual"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Contraseña nueva</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control required strength" id="contrasenia" name="contrasenia">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Confirmar contraseña</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control required" id="confirmar" name="confirmar">
                            <div id="msg_confirmar"></div>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary" id="guardar" name="guardar">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <input type="hidden" id="id_user" name="id_user" value="{{$user_find->id}}">
                    <a href="{{ route('admin.user.list', ['nav'=>'user', 'action'=>'list']) }}" class="btn btn-primary">
                        Cancelar <i class="icon-cross position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //VERIFICAMOS CONTRASEÑA ACTUAL
            $('#contrasenia_actual').blur(function(e){
                var contrasenia_actual = $('#contrasenia_actual').prop('value');
                var id_user = $('#id_user').prop('value');
                var err='';
                //alert(id_user);
                if(contrasenia_actual!=''){
                    $.get( "{{url('/')}}/admin/user/pass_now_ajax/"+id_user+"/"+contrasenia_actual, function( data ) {
                        //console.log(data);
                        if(data==1){
                            err='contraseña actual correcta';
                            $('#contrasenia_actual').each(function(indice, element) {
                                removeClassE(element);
                                addClassE(element,err);
                            });
                        }else if(data==0){
                            err='La contraseña actual es incorrecta';
                            $('#contrasenia_actual').each(function(indice, element) {
                                removeClassE(element);
                                addClassE(element,err);
                            });
                            $('#contrasenia_actual').focus();
                        }
                    });
                }else{
                    //$('#err_pass_actual').html('');
                    //$('#contrasenia_actual').focus();
                    err='Esta informacion es obligatoria';
                    $('#contrasenia_actual').each(function(indice, element) {
                        removeClassE(element);
                        addClassE(element,err);
                    });
                    $('#contrasenia_actual').focus();
                }
            });

            //CONFIRMAMOS LA CONTRASEÑA
            $('#confirmar').keyup(function(e){
                var password_repite = $('#confirmar').prop('value');
                var password_nuevo = $('#contrasenia').prop('value');
                var err='';
                if(password_nuevo==password_repite){
                    //$("#btn_cambiar_pass").removeAttr("disabled");
                    /*$("#msg_confirmar").html('contraseñas iguales');
                    setTimeout(function() {
                        // Do something after 2 seconds
                        $("#msg_confirmar").html('');
                    }, 3000);
                    */
                    $('#guardar').prop('disabled', false);
                    err='Contraseña confirmada';
                    $('#confirmar').each(function(indice, element) {
                        removeClassE(element);
                        addClassE(element,err);
                    });
                }else{
                    $('#guardar').prop('disabled', true);
                    err='Las contraseñas tienen que ser iguales';
                    $('#confirmar').each(function(indice, element) {
                        removeClassE(element);
                        addClassE(element,err);
                    });
                }
            });

            //VERIFICAMOS EL FORMULARIO
            $('#userChangeForm').submit(function(e){
                var sw = true;
                var err = 'Esta informacion es obligatoria';
                $(this).find('.required, .not-required').each(function(index, element) {
                    //alert(element.type+'='+element.value);
                    if($(this).hasClass('required') === true){
                        if(validateElement(element,err) === false){
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
                if(!$("#"+_id+" + .msg-form").length) {
                    $("#"+_id+":last").after('<span class="msg-form">'+err+'</span>');
                }
            }
            //REMOVEMOS CLASE
            function removeClassE(element){
                var _id = $(element).prop('id');
                //$(element).removeClass('error-text');
                if($("#"+_id+" + .msg-form").length) {
                    $("#"+_id+" + .msg-form").remove();
                }
            }

        });
    </script>
@endsection