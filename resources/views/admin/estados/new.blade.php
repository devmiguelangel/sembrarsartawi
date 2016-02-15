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
                <span class="form-wizard-count"><i class="icon-file-text2"></i></span>
                Nuevo Registro agregar estados a productos
                <small class="display-block">Formulario</small>
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

            {!! Form::open(array('route' => 'new_states', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            @if(count($retailer)>0)
                                <select name="id_retailer" id="id_retailer" class="form-control required">
                                    <option value="0">Seleccione</option>
                                    @foreach($retailer as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-warning alert-styled-left">
                                    <span class="text-semibold"></span>No existe Retailer registrado.<br>- El Retailer no esta activado
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Producto <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="id_producto_retailer" id="id_producto_retailer" class="form-control required" disabled>
                                <option value="0">Seleccione</option>
                            </select>
                            <div id="msg_error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Estados</label>
                        <div class="col-lg-10">
                            <select multiple="multiple" name="estados[]" id="id_estados" class="form-control required" disabled>
                                @foreach($states as $data_state)
                                <option value="{{$data_state->id}}">{{$data_state->state}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary" disabled>
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{route('admin.estados.list', ['nav'=>'state', 'action'=>'list'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //BUSCAMOS LOS PRODUCTOS AGREGADOS AL RETAILER
            $('#id_retailer').change(function(e) {
                var  id_retailer = $(this).prop('value');
                //alert(id_retailer);
                $.get( "{{url('/')}}/admin/estados/product_retailer_ajax/"+id_retailer, function( data ) {
                    console.log(data);
                    if(data.length>0) {
                        $('button[type="submit"]').prop('disabled', false);
                        $('#id_producto_retailer').prop('disabled', false);
                        $('#id_estados').prop('disabled',false);
                        $('#id_producto_retailer option').remove();
                        $('#id_producto_retailer').append('<option value="0">Seleccione</option>');
                        $('#msg_error').html('');
                        $.each(data, function () {
                            console.log("ID: " + this.id_retailer_product);
                            console.log("First Name: " + this.product);
                            $('#id_producto_retailer').append('<option value="'+this.id_retailer_product+'">'+this.product+'</option>');
                        });
                    }else{
                        $('#id_retailer option[value="0"]').prop('selected',true);
                        $('button[type="submit"]').prop('disabled', true);
                        $('#id_estados').prop('disabled',true);
                        $('#msg_error').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span> - No existen productos agregados a un Retailer.<br>- No Existen productos humanitarios</div>');
                    }
                });
            });


            $('#id_producto_retailer').change(function(e){
                var id_product_retailer = $(this).prop('value');
                if(id_product_retailer!=0){
                    var state;
                    var state_retailer;
                    var sw=0;

                    $.get( "{{url('/')}}/admin/estados/retailer_state_ajax/"+id_product_retailer, function( json ) {
                        console.log(json);

                        $('#id_estados option').remove();
                        $.each(json, function (key, data) {
                            console.log(key)
                            if(key=='state'){
                                state = data;
                            }else if(key=='stateretailer'){
                                state_retailer = data;
                            }
                        });
                        $.each(state, function () {
                            console.log("ID: " + this.id_state);
                            console.log("Profiles: " + this.state);
                            var id_state = this.id_state;
                            var state = this.state;
                            $.each(state_retailer, function () {
                                var ad_state_id = this.ad_state_id;
                                if(id_state==ad_state_id){
                                    $('#id_estados').append('<option value="'+id_state+'" selected>'+state+'</option>');
                                    sw=id_state;
                                }
                            });
                            if(id_state!=sw){
                                $('#id_estados').append('<option value="'+id_state+'">'+state+'</option>');
                            }
                        });

                    });
                }else{
                    $.get( "{{url('/')}}/admin/estados/states_ajax/"+id_product_retailer, function( json ) {
                        $('#id_estados option').remove();
                        $.each(json, function () {
                            console.log("ID: " + this.id_state);
                            console.log("First Name: " + this.state);
                            $('#id_estados').append('<option value="'+this.id_state+'">'+this.state+'</option>');
                        });
                    });
                }
            });

            /*
            $('#id_estados').change(function(e){
                var id_state = $(this).prop('value');
                alert(id_state);
            });
            */

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