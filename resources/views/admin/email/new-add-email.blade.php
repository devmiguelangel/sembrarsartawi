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
                <small class="display-block">Nuevo registro </small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.email.new-email', ['nav'=>'email', 'action'=>'new_email'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Crear nuevo correo</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'new_add_email', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">


                    <div class="form-group">
                        <label class="control-label col-lg-2">Productos <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="id_product_retail" id="id_product_retail" class="form-control">
                                <option value="0">Seleccione</option>
                                @foreach($query as $data)
                                    <option value="{{$data->id_retailer_product}}">{{$data->product}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Correos electronicos <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select multiple="multiple" class="form-control required" name="email[]" id="id_email" disabled data-popup="tooltip" title="Presione la tecla [Ctrl] para seleccionar mas opciones">
                                @foreach($query_email as $data_email)
                                    <option value="{{$data_email->id}}">{{$data_email->name}} - {{$data_email->email}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary" disabled>Guardar <i class="icon-floppy-disk position-right"></i></button>
                    <a href="{{route('admin.email.list-email-product-retailer', ['nav'=>'email', 'action'=>'list_epr'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //HABILITAR/DESABILITAR CAMPOS
            $('#id_product_retail').change(function(){
                var id_product_retailer = $(this).prop('value');
                //alert(id_product_retailer);
                if(id_product_retailer!=0){
                    $('#id_email').prop('disabled', false);
                    $('button[type="submit"]').prop('disabled', false);
                    if($("#id_email + .validation-error-label").length) {
                        $("#id_email + .validation-error-label").remove();
                    }
                    var emails;
                    var retailer_email;
                    var sw=0;
                    $.get( "{{url('/')}}/admin/email/email_retailer_product_ajax/"+id_product_retailer, function( json ) {
                        //console.log(json)
                        $('#id_email option').remove();
                        $.each(json, function (key, data) {
                            //console.log(key)
                            if(key=='retaileremail'){
                                retailer_email = data;
                            }else if(key=='email'){
                                emails = data;
                            }
                        });
                        $.each(emails, function () {
                            //console.log("ID: " + this.id_email);
                            //console.log("Profiles: " + this.correo);
                            //console.log("name: " + this.name);
                            var id_email = this.id_email;
                            var correos = this.correo;
                            var nombres = this.name;
                            $.each(retailer_email, function () {
                                var ad_email_id = this.ad_email_id;
                                if(id_email==ad_email_id){
                                    $('#id_email').append('<option value="'+id_email+'" selected>'+nombres+' - '+correos+'</option>');
                                    sw=id_email;
                                }
                            });
                            if(id_email!=sw){
                                $('#id_email').append('<option value="'+id_email+'">'+nombres+' - '+correos+'</option>');
                            }
                        });
                    });
                }else{
                    $('#id_email').prop('disabled', true);
                    $('button[type="submit"]').prop('disabled', true);
                    $('#id_email option[value="0"]').prop('selected',true);
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