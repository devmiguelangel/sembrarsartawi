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
                <small class="display-block">Agregar departamento a Retailer</small>
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

            {!! Form::open(array('route' => 'add_city_retailer', 'name' => 'CreateForm', 'id' => 'CreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}

                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer</label>
                        <div class="col-lg-10">
                            <select name="id_retailer" id="id_retailer" class="form-control required">
                                <option value="0">Seleccione</option>
                                @foreach($retailer as $dat_ret)
                                    <option value="{{$dat_ret->id}}">{{$dat_ret->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Departamentos</label>
                        <div class="col-lg-10">
                            <select multiple="multiple" name="city[]" id="id_city" class="form-control required" disabled data-popup="tooltip" title="Presione la tecla [Ctrl] para seleccionar mas opciones">
                                @foreach($city as $dat_city)
                                    <option value="{{$dat_city->id}}">{{$dat_city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{route('admin.cities.list-city-retailer', ['nav'=>'city', 'action'=>'list_city_retailer'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-cross position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //VISUALIZAR DEPARTAMENTOS Y FERIFICAR SI ESTAN ADICIONADOS A UN RETAILER
            $('#id_retailer').change(function(e){
                var id_retailer = $(this).prop('value');
                //alert(id_retailer);
                if(id_retailer!=0){
                    var cities;
                    var cities_retailer;
                    var sw=0;
                    $('#id_city').prop('disabled',false);
                    $.get( "{{url('/')}}/admin/cities/retailer_city_ajax/"+id_retailer, function( json ) {
                        console.log(json);

                        $('#id_city option').remove();
                        $.each(json, function (key, data) {
                            console.log(key)
                            if(key=='city'){
                                cities = data;
                            }else if(key=='cityretailer'){
                                cities_retailer = data;
                            }
                        });
                        $.each(cities, function () {
                            console.log("ID: " + this.id_city);
                            console.log("Profiles: " + this.cities);
                            var id_city = this.id_city;
                            var cities = this.cities;
                            $.each(cities_retailer, function () {
                                var ad_city_id = this.ad_city_id;
                                if(id_city==ad_city_id){
                                    $('#id_city').append('<option value="'+id_city+'" selected>'+cities+'</option>');
                                    sw=id_city;
                                }
                            });
                            if(id_city!=sw){
                                $('#id_city').append('<option value="'+id_city+'">'+cities+'</option>');
                            }
                        });

                    });
                }else{
                    $("#id_city option:selected").removeAttr("selected");
                    $('#id_city').prop('disabled',true);
                }

            });

            //VERIFICAMOS EL FORMULARIO
            $('#CreateForm').submit(function(e){
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
                }else if($(element).hasClass('dominio') === true){
                    regex = /^([a-z])*$/;
                    err = 'Ingrese solo letras minusculas';
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