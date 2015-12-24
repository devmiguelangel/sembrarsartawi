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
            <h5 class="panel-title">Formulario editar usuario</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'update_user', 'name' => 'userUpdateForm', 'id' => 'userUpdateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                @if(!empty($user_find))

                        <fieldset class="content-group">

                        <div class="form-group">
                            <label class="control-label col-lg-2">Tipo de usuario</label>
                            <div class="col-lg-10">
                                <select name="tipo_usuario" id="tipo_usuario" class="form-control required">
                                    <option value="0"
                                        @if($user_find->ad_user_type_id=='')
                                            selected
                                        @endif
                                    >Seleccione</option>
                                    <option value="1"
                                        @if($user_find->ad_user_type_id==1)
                                            selected
                                        @endif
                                    >Administrador</option>
                                    <option value="2"
                                        @if($user_find->ad_user_type_id==2)
                                            selected
                                        @endif
                                    >Usuario</option>
                                    <option value="3"
                                        @if($user_find->ad_user_type_id==3)
                                            selected
                                        @endif
                                    >Operador</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Departamento</label>
                            <div class="col-lg-10">
                                @if(!empty($cities))
                                    <select name="depto" class="form-control required" id="depto">
                                        <option value="0">Seleccione</option>
                                        @foreach($cities as $arrcity)
                                            @if($user_find->ad_city_id==$arrcity->id)
                                                <option value="{{$arrcity->id}}" selected>{{$arrcity->name}}</option>
                                            @else
                                                <option value="{{$arrcity->id}}">{{$arrcity->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Agencia</label>
                            <div class="col-lg-10">
                                <select id="agencia" name="agencia" class="form-control required">
                                    <option value="0">Seleccione</option>
                                    @foreach($agencies as $arragency)
                                        @if($arragency->id==$user_find->ad_agency_id)
                                            <option value="{{$arragency->id}}" selected>{{$arragency->name}}</option>
                                        @else
                                            <option value="{{$arragency->id}}">{{$arragency->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span id="msg_agencia"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Usuario</label>
                            <div class="col-lg-10" style="font-weight: bold;">
                                {{$user_find->username}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Nombre Completo</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control required" name="txtNombre" id="txtNnombre" autocomplete="off" value="{{$user_find->full_name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Telefono agencia</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="txtTelefono" id="txtTelefono" autocomplete="off" value="{{$user_find->phone_number}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Correo electrónico</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control required" name="txtEmail" id="txtEmail" autocomplete="off" value="{{$user_find->email}}">
                            </div>
                        </div>

                    </fieldset>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            Guardar <i class="icon-arrow-right14 position-right"></i>
                        </button>

                        <a href="{{ route('admin.user.list', ['nav'=>'user', 'action'=>'list']) }}" class="btn btn-primary">
                            Cancelar <i class="icon-arrow-right14 position-right"></i>
                        </a>
                        <input type="hidden" id="id_user" name="id_user" value="{{$user_find->id}}">
                    </div>
                @endif
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //OBTENER LISTA DE AGENCIAS DE ACUERDO AL DEPARTAMENTO
            $('#depto').change(function(e) {
                var id_depto = $(this).val();
                alert(id_depto);
                $.get( "{{url('/')}}/admin/user/agency_ajax/"+id_depto, function( data ) {
                    console.log(data);
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

            //VERIFICAMOS EL FORMULARIO
            $('#userUpdateForm').submit(function(e){
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