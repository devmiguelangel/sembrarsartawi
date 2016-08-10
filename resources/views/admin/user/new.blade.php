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

            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'create_user', 'name' => 'userForm', 'id' => 'userForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Tipo de usuario <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="tipo_usuario" id="tipo_usuario" class="form-control required">
                                <option value="0">Seleccione</option>
                                @foreach($query_type_user as $type)
                                    @if(auth()->user()->type->code=='ADT')
                                        <option value="{{$type->id}}|{{$type->code}}">{{$type->name}}</option>
                                    @else
                                        @if($type->code=='UST')
                                            <option value="{{$type->id}}|{{$type->code}}">{{$type->name}}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="display: none;" id="content-user-profiles">
                        <label class="control-label col-lg-2">Perfiles <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select id="id_profile" name="id_profile" class="">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="display: none;" id="content-company">
                        <label class="control-label col-lg-2">Compañías <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select id="id_company" name="id_company" class="">
                                <option value="0">Seleccione</option>
                            </select>
                            <div id="msg_company"></div>
                        </div>
                    </div>

                    <div class="form-group" style="display: none;" id="content-permissions">
                        <label class="control-label col-lg-2">Permisos </label>
                        <div class="col-lg-10">
                            <select multiple="multiple" class="" name="permiso[]" id="permiso" data-popup="tooltip" title="Presione la tecla [Ctrl] para seleccionar mas opciones, asi mismo para deseleccionarlos">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            @if(count($retailer)>0)
                                <select name="id_retailer" id="id_retailer" class="form-control required">
                                    <option value="0">Seleccione</option>
                                    @foreach($retailer as $data_retailer)
                                        <option value="{{$data_retailer->id}}">{{$data_retailer->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-warning alert-styled-left">
                                    <span class="text-semibold"></span> No existe Retailer registrado.<br>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group" style="display: none;" id="content-product">
                        <label class="control-label col-lg-2">Productos <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select multiple="multiple" class="" name="product[]" id="product" data-popup="tooltip" title="Presione la tecla [Ctrl] para seleccionar mas opciones, asi mismo para deseleccionarlos">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Departamento <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            @if(!empty($cities))
                                <select name="depto" class="form-control required" id="depto">
                                    <option value="0">Seleccione</option>
                                    @foreach($cities as $data)
                                        <option value="{{$data->id_retailer_city}}|{{$data->id_city}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-warning alert-styled-left">
                                    <span class="text-semibold"></span> No existe departamentos registrados en el Retailer.<br>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group" style="display: none;" id="content-agency">
                        <label class="control-label col-lg-2">Agencia <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select id="agencia" name="agencia" class="form-control required">
                                <option value="0">Seleccione</option>
                            </select>
                            <div id="msg_agencia"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Usuario <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required" name="txtIdusuario" id="txtIdusuario" autocomplete="off">
                            <div id="msg_usuario"></div>
                        </div>
                    </div>

                    <div class="form-group" id="content-password">
                        <label class="control-label col-lg-2">Contraseña <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control required" name="contrasenia" id="contrasenia" maxlength="14" autocomplete="off">
                        </div>
                        <div id="messages"></div>
                    </div>

                    <div class="form-group" id="content-confirm-password">
                        <label class="control-label col-lg-2">Confirmar Contraseña <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control required" name="confirmar" id="confirmar" maxlength="14" autocomplete="off">
                            <div id="msg_confirmar"><div id="error_contrasenia_igual"></div></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Nombre Completo <span class="text-danger">*</span></label>
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
                        <label class="control-label col-lg-2">Correo electronico <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required email" name="txtEmail" id="txtEmail" autocomplete="off">
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    @if(count($retailer)>0 && count($cities)>0)
                        <button type="submit" class="btn btn-primary">
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary" disabled>
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @endif
                    <a href="{{route('admin.user.list', ['nav'=>'user', 'action'=>'list'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-cross position-right"></i>
                    </a>
                    @if(empty($cities))
                        <a href="{{route('admin.cities.list-city-retailer', ['nav'=>'city', 'action'=>'list_city_retailer'])}}" class="btn btn-primary">
                            Agregar departamentos a Retailer <i class="icon-pencil3 position-right"></i>
                        </a>
                    @endif
                    <input type="hidden" id="session_type_user" value="{{auth()->user()->type->code}}">
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //$("select.readonly option").not(":selected").attr("disabled", "disabled");

            //OCULTAMOS LOS CAMPOS PASSWORD Y CONFIRMAR PASSWORD PUESTO QUE EL TIPO DE USUARIO ES OPT
            if($('#session_type_user').prop('value')=='OPT'){
                $('#content-password').fadeOut('fast');
                $('#content-confirm-password').fadeOut('fast');
                //$('#content-company').fadeOut('fast');
                $('#contrasenia').removeClass('form-control required');
                $('#confirmar').removeClass('form-control required');
                //$('#id_company').removeClass('form-control requerid');
            }

            //OBTENER LISTA DE AGENCIAS DE ACUERDO AL DEPARTAMENTO
            $('#depto').change(function(e) {
                var  _data= $(this).prop('value');
                var array = _data.split('|');
                var id_retailer_city = array[0];
                var _datatu = $('#tipo_usuario option:selected').prop('value');
                var vec = _datatu.split('|');
                //alert(type_user);
                if(id_retailer_city!=0){
                    if(vec[1]=='UST'){//SI EL TIPO ES USUARIO
                        var id_profile = $('#id_profile option:selected').prop('value').split('|');
                        //alert(id_profile);
                        if(id_profile[1]!='COP'){//SI EL PROFILE ES DISTINTO DE COMPAÑIA SE HABILITA AGENCIA
                            $.get( "{{url('/')}}/admin/user/agency_ajax/"+id_retailer_city, function( data ) {
                                //console.log(data);
                                $('#content-agency').fadeIn('slow');
                                $('#agencia option').remove();
                                $('#agencia').addClass('form-control required');
                                $('#agencia').append('<option value="0">Seleccione</option>');
                                if(data.length>0) {
                                    $('#msg_agencia').html('');
                                    $.each(data, function () {
                                        //console.log("ID: " + this.id);
                                        //console.log("First Name: " + this.name);
                                        $('#agencia').append('<option value="'+this.id+'">'+this.name+'</option>');
                                    });
                                }else{
                                    $('#msg_agencia').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span> No existen agencias agregadas al departamento.<br><a href="{{route('admin.agencies.list-agency-retailer', ['nav'=>'agency', 'action'=>'list_agency_retailer'])}}">Ingresar agencias a departamento</a></div>');
                                }
                            });
                        }else{//SI EL PROFILE ES COMPAÑIA SE DESHABILITA AGENCIA
                            $('#content-agency').fadeOut('fast');
                            $('#agencia').removeClass('form-control required');
                        }
                    }else{
                        $.get( "{{url('/')}}/admin/user/agency_ajax/"+id_retailer_city, function( data ) {
                            //console.log(data);
                            $('#content-agency').fadeIn('slow');
                            $('#agencia option').remove();
                            $('#agencia').append('<option value="0">Seleccione</option>');
                            if(data.length>0) {
                                $('#msg_agencia').html('');
                                $.each(data, function () {
                                    //console.log("ID: " + this.id);
                                    //console.log("First Name: " + this.name);
                                    $('#agencia').append('<option value="'+this.id+'">'+this.name+'</option>');
                                });
                            }else{
                                $('#msg_agencia').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span> No existen agencias agregadas al departamento.<br><a href="{{route('admin.agencies.list-agency-retailer', ['nav'=>'agency', 'action'=>'list_agency_retailer'])}}">Ingresar agencias a departamento</a></div>');
                            }
                        });
                    }
                }else{
                    $('#agencia option[value="0"]').prop('selected',true);
                    $('#content-agency').fadeOut('fast');
                }
            });

            //OBTENER EL LISTA DE PERFILES DE USUARIO
            $('#tipo_usuario').change(function(e){
                var _id = $(this).prop('value');
                var arr = _id.split("|");
                var tipo_usuario = arr[0];
                var session_type_user = $('#session_type_user').prop('value');
                //alert('tipo usuario sesion: '+session_type_user);
                //alert(arr[1]);
                if(arr[1]=='UST' || arr[1]=='OPT'){
                    //alert(tipo_usuario);
                    $('#depto option[value="0"]').prop('selected',true);
                    $('#agencia option[value="0"]').prop('selected',true);
                    $('#content-agency').fadeOut('fast');
                    $.get( "{{url('/')}}/admin/user/profiles_ajax/"+session_type_user, function( data ) {
                        if(arr[1]=='UST'){
                            $('#id_profile').addClass('form-control required');
                            $('#content-user-profiles').fadeIn('fast');
                            $('#id_profile option').remove();
                            $('#id_profile').append('<option value="0">Seleccione</option>');
                            if(data.length>0){
                                $.each(data, function () {
                                    //console.log("ID: " + this.id);
                                    //console.log("Profiles: " + this.name);
                                    //console.log("slug: "+this.slug);
                                    $('#id_profile').append('<option value="'+this.id+'|'+this.slug+'">'+this.name+'</option>');
                                });
                            }
                        }else{
                            $('#id_profile').removeClass('form-control required');
                            $('#id_company').removeClass('form-control required');
                            $('#product').removeClass('form-control requerid');
                            $('#content-user-profiles').fadeOut('fast');
                            $('#content-company').fadeOut('fast');
                            $('#content-product').fadeOut('fast');
                        }
                    });

                    $.get( "{{url('/')}}/admin/user/permissions_ajax/"+arr[1], function( data ) {

                        $('#permiso').addClass('form-control');
                        $('#content-permissions').fadeIn('fast');
                        $('#permiso option').remove();
                        if(data.length>0){
                            $.each(data, function () {
                                //console.log("ID: " + this.id);
                                //console.log("Profiles: " + this.name);
                                $('#permiso').append('<option value="'+this.id+'">'+this.name+'</option>');
                            });
                        }

                    });

                }else{
                    $('#id_profile').removeClass('form-control required');
                    $('#content-user-profiles').fadeOut('fast');
                    $('#permiso').removeClass('form-control');
                    $('#content-permissions').fadeOut('fast');
                    $('#depto option[value="0"]').prop('selected',true);
                    $('#agencia option[value="0"]').prop('selected',true);
                    $('#content-agency').fadeOut('fast');
                }
            });

            /*  PERFILES VERIFICAMOS LA OPCION SELECCIONADA COMPAÑIA*/
            $('#id_profile').change(function() {
                $('#depto option[value="0"]').prop('selected', true);
                $('#agencia option[value="0"]').prop('selected', true);
                $('#content-agency').fadeOut('fast');
                //alert($(this).prop('value'));
                var arrSlug = $(this).prop('value').split('|');
                if (arrSlug[1] == 'COP') {
                    $('#product').removeClass('form-control requerid');
                    $('#content-product').fadeOut('fast');
                    $.get("{{url('/')}}/admin/user/idcompany_ajax/" + arrSlug[0], function (data) {
                        //console.log(data);
                        $('#content-company').fadeIn('fast');
                        $('#id_company option').remove();
                        $('#id_company').addClass('form-control required');
                        $('#id_company').append('<option value="0">Seleccione</option>');
                        if (data.length > 0) {
                            $('#msg_company').html('');
                            $.each(data, function () {
                                //console.log("ID: " + this.id);
                                //console.log("First Name: " + this.name);
                                $('#id_company').append('<option value="' + this.id + '">' + this.name + '</option>');
                            });
                        } else {
                            $('#msg_company').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span> No existen Compañías de Seguros<br><a href="{{route('admin.company.list', ['nav'=>'company', 'action'=>'list'])}}">Ingresar compañía de seguros</a></div>');
                        }
                    });

                }else if(arrSlug[1] == 'SEP'){
                    $('#id_company').removeClass('form-control required');
                    $('#content-company').fadeOut('fast');
                    $.get("{{url('/')}}/admin/user/idproduct_ajax/" + arrSlug[0], function(data){
                        $('#product').addClass('form-control required');
                        $('#content-product').fadeIn('fast');
                        $('#product option').remove();
                        if(data.length>0){
                            $.each(data, function () {
                                console.log("ID: " + this.id);
                                console.log("Product: " + this.name);
                                $('#product').append('<option value="'+this.id+'">'+this.name+'</option>');
                            });
                        }
                    });
                }else{
                    $('#id_company').removeClass('form-control required');
                    $('#content-company').fadeOut('fast');
                    $('#product').removeClass('form-control requerid');
                    $('#content-product').fadeOut('fast');
                }
            });

            //VERIFICAMOS SI EL USUARIO EXISTE
            $("#txtIdusuario").blur(function(e){
                var usuario = $("#txtIdusuario").prop('value');
                //alert(usuario);
                if(usuario.match(/^[a-zA-Z]+$/)){
                    $.get( "{{url('/')}}/admin/user/finduser_ajax/"+usuario, function( data ) {
                        //console.log(data);
                        if(data.length>0){
                            $('#msg_usuario').html('el usuario '+usuario+' ya existe');
                            $('#txtIdusuario').focus();
                            $('button[type="submit"]').prop('disabled', true);
                        }else{
                            $('#msg_usuario').html('');
                            $('button[type="submit"]').prop('disabled', false);
                        }
                    });
                }else{
                    $("#txtIdusuario").prop('value','');
                }
            });

            //CONFIRMAR SI EXISTE CORREO ELECTRONICO
            $('#txtEmail').keyup(function(){
                var email = $(this).prop('value');
                var regex = /^([a-z]+[a-z0-9._-]*)@{1}([a-z0-9\.]{2,})\.([a-z]{2,3})$/;
                if(regex.test(email)){
                    /*

                    */
                    $.get( "{{url('/')}}/admin/user/find_email_ajax/"+email, function( data ) {
                        console.log(data);
                        if(data==0){
                            if($("#txtEmail + .validation-error-label").length) {
                                $("#txtEmail + .validation-error-label").remove();
                            }
                            $('button[type="submit"]').prop('disabled', false);
                        }else{
                            if($("#txtEmail + .validation-error-label").length) {
                                $("#txtEmail + .validation-error-label").remove();
                            }
                            if(!$("#txtEmail + .validation-error-label").length) {
                                $("#txtEmail:last").after('<span class="validation-error-label">El email ya existe, ingrese otro</span>');
                            }
                        }
                    });
                }else{
                    if($("#txtEmail + .validation-error-label").length) {
                        $("#txtEmail + .validation-error-label").remove();
                    }
                    $('button[type="submit"]').prop('disabled', true);
                    if(!$("#txtEmail + .validation-error-label").length) {
                        $("#txtEmail:last").after('<span class="validation-error-label">Email invalido</span>');
                    }
                }
            });

            //CONFIRMAMOS CONTRASEÑA
            $('#confirmar').keyup(function(e){
                var password_repite = $('#confirmar').prop('value');
                var password_nuevo = $('#contrasenia').prop('value');

                if(password_nuevo==password_repite){
                    $('button[type="submit"]').prop('disabled', false);
                    $("#msg_confirmar").html('contrase&ntilde;as iguales');
                    setTimeout(function() {
                        // Do something after 2 seconds
                        $("#msg_confirmar").html('');
                    }, 3000);
                }else{
                    $('button[type="submit"]').prop('disabled', true);
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