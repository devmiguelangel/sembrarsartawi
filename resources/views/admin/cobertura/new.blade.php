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
                Agregar nueva Cobertura
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

            {!! Form::open(array('route' => 'new_coverage', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer</label>
                        <div class="col-lg-10">
                            @if(count($query)>0)
                                <select name="id_retailer" id="id_retailer" class="form-control required">
                                    <option value="0">Seleccione</option>
                                    @foreach($query as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-warning alert-styled-left">
                                    <span class="text-semibold"></span>- No existe Retailer registrado.<br>- El Retailer no esta activado
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Producto</label>
                        <div class="col-lg-10">
                            <select name="id_product" id="id_product" class="form-control required" disabled>
                                <option value="0">Seleccione</option>
                            </select>
                            <div id="msg_error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Cobertura</label>
                        <div class="col-lg-10">
                            <select name="id_cobertura" id="id_cobertura" class="form-control required">
                                <option value="0">Seleccione</option>
                                @foreach($query_coverage as $dat_coverage)
                                <option value="{{$dat_coverage->id}}">{{$dat_coverage->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Numero de Titulares</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required number" name="num_titulares" id="num_titulares" maxlength="3">
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{route('admin.cobertura.list', ['nav'=>'coverage', 'action'=>'list'])}}" class="btn btn-primary">
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
                $.get( "{{url('/')}}/admin/cobertura/product_retailer_ajax/"+id_retailer, function( data ) {
                    console.log(data);
                    if(data.length>0) {
                        $('button[type="submit"]').prop('disabled', false);
                        $('#id_product').prop('disabled', false);
                        $('#id_product option').remove();
                        $('#id_product').append('<option value="0">Seleccione</option>');
                        $('#msg_error').html('');
                        $.each(data, function () {
                            console.log("ID: " + this.id_retailer_product);
                            console.log("First Name: " + this.product);
                            $('#id_product').append('<option value="'+this.id_retailer_product+'">'+this.product+'</option>');
                        });
                    }else{
                        $('#id_retailer option[value="0"]').prop('selected',true);
                        $('button[type="submit"]').prop('disabled', true);
                        $('#msg_error').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span> - No existen productos agregados a un Retailer.<br>- No Existen productos humanitarios</div>');
                    }
                });
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