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
            <h5 class="panel-title">Formulario resetear contraseña</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'reset_pass', 'name' => 'userResetForm', 'id' => 'userResetForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Usuario</label>
                        <div class="col-lg-10" style="font-weight: bold;">
                            {{$user_find->full_name}}
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
            //CONFIRMAMOS LA CONTRASEÑA
            $('#confirmar').keyup(function(e){
                var password_repite = $('#confirmar').prop('value');
                var password_nuevo = $('#contrasenia').prop('value');

                if(password_nuevo==password_repite){
                    if($("#confirmar + .msg-form").length) {
                        $("#confirmar + .msg-form").remove();
                    }
                    $('#guardar').prop('disabled', false);
                    if(!$("#confirmar + .msg-form").length) {
                        $("#confirmar:last").after('<span class="msg-form">Contraseñas iguales</span>');
                    }
                }else{
                    if($("#confirmar + .msg-form").length) {
                        $("#confirmar + .msg-form").remove();
                    }
                    $('#guardar').prop('disabled', true);
                    if(!$("#confirmar + .msg-form").length) {
                        $("#confirmar:last").after('<span class="msg-form">Las contraseñas tienen que ser iguales</span>');
                    }
                }
            });

            //VERIFICAMOS EL FORMULARIO
            $('#userResetForm').submit(function(e){
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