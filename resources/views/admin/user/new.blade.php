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
            <h5 class="panel-title">Formulario nuevo usuario</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'create_user', 'name' => 'userForm', 'id' => 'userForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Tipo de usuario</label>
                        <div class="col-lg-10">
                            <select name="tipo_usuario" id="tipo_usuario" class="form-control required">
                                <option value="0">Seleccione</option>
                                <option value="1">Administrador</option>
                                <option value="2">Usuario</option>
                                <option value="3">Operador</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Departamento</label>
                        <div class="col-lg-10">
                            @if(!empty($cities))
                                <select name="depto" class="form-control required" id="depto">
                                    <option value="0">Seleccione</option>
                                    @foreach($cities as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>

                    <div class="form-group" style="display: none;" id="content-agency">
                        <label class="control-label col-lg-2">Agencia</label>
                        <div class="col-lg-10">
                            <select id="agencia" name="agencia" class="form-control required">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Usuario</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required" name="txtIdusuario" id="txtIdusuario" autocomplete="off">
                            <div id="msg_usuario"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Contraseña</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control required" name="contrasenia" id="contrasenia">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Confirmar Contraseña</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control required" name="confirmar" id="confirmar">
                            <div id="msg_confirmar"><div id="error_contrasenia_igual"></div></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Nombre Completo</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required text" name="txtNombre" id="txtNnombre" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Telefono agencia</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control not-required number" name="txtTelefono" id="txtTelefono" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Correo electronico</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required email" name="txtEmail" id="txtEmail" autocomplete="off">
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-arrow-right14 position-right"></i>
                    </button>

                    <a href="{{route('admin.user.list', ['nav'=>'user', 'action'=>'list'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){

            //OBTENER LISTA DE AGENCIAS DE ACUERDO AL DEPARTAMENTO
            $('#depto').change(function(e) {
                var id_depto = $(this).val();
                //alert(id_depto);
                $.get( "{{url('/')}}/admin/user/agency_ajax/"+id_depto, function( data ) {
                    console.log(data);
                    $('#content-agency').fadeIn('slow');
                    $('#agencia option').remove();
                    $('#agencia').append('<option value="0">Seleccione</option>');
                    if(data.length>0) {
                        $('#msg_agencia').html('');
                        $.each(data, function () {
                            console.log("ID: " + this.id);
                            console.log("First Name: " + this.name);
                            $('#agencia').append('<option value="'+this.id+'">'+this.name+'</option>');
                        });
                    }else{
                        $('#msg_agencia').html('No existe ningun registro');
                    }
                });
            });

            //VERIFICAMOS SI EL USUARIO EXISTE
            $("#txtIdusuario").blur(function(e){
                var usuario = $("#txtIdusuario").prop('value');
                alert(usuario);
                if(usuario.match(/^[a-zA-Z]+$/)){
                    $.get( "{{url('/')}}/admin/user/finduser_ajax/"+usuario, function( data ) {
                        console.log(data);
                        if(data.length>0){
                            $('#msg_usuario').html('el usuario '+usuario+' ya existe');
                        }else{
                            $('#msg_usuario').html('');
                        }
                    });
                }else{
                    $("#txtIdusuario").prop('value','');
                }
            });

            //CONFIRMAMOS CONTRASEÑA
            $('#confirmar').keyup(function(e){
                var password_repite = $('#confirmar').prop('value');
                var password_nuevo = $('#contrasenia').prop('value');

                if(password_nuevo==password_repite){
                    //$("#btn_cambiar_pass").removeAttr("disabled");
                    $("#msg_confirmar").html('contrase&ntilde;as iguales');
                    setTimeout(function() {
                        // Do something after 2 seconds
                        $("#msg_confirmar").html('');
                    }, 3000);
                }else{
                    $("#msg_confirmar").html("Las contrase&ntilde;as tienen que ser iguales");
                    //$("#txtPassRepite").css({'border' : '1px solid #d44d24'}).focus();
                    e.preventDefault();
                    //$("#btn_cambiar_pass").attr("disabled", true);
                }

                //alert(confirmar);
            });

            //VERIFICAMOS EL FORMULARIO
            $('#userForm').submit(function(e){
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