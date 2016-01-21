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
                    <i class="icon-pencil7"></i>
                </span>
                Formulario
                <small class="display-block">Editar registro </small>
            </h5>
            <div class="heading-elements">
                <!--
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
                -->
            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'update_parameter_additional', 'name' => 'ParameterForm', 'id' => 'ParameterForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Nombre <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="prod_param" id="prod_param" class="form-control required">
                                <option value="">Seleccione</option>
                                @foreach(config('base.product_parameters') as $key=>$data)
                                    @if($key==$query->slug)
                                        <option value="{{$key}}" selected>{{$data}}</option>
                                    @else
                                        <option value="{{$key}}">{{$data}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @var $j=18
                    <div class="form-group">
                        <label class="control-label col-lg-2">Edad Mínima <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="edad_min" id="edad_min" class="form-control required">
                                <option value="0">Seleccione</option>
                                @while($j<=85)
                                    @if($j==$query->age_min)
                                        <option value="{{$j}}" selected>{{$j}}</option>
                                    @else
                                        <option value="{{$j}}">{{$j}}</option>
                                    @endif
                                    @var $j=$j+1
                                @endwhile
                            </select>
                        </div>
                    </div>
                    @var $i=18
                    <div class="form-group">
                        <label class="control-label col-lg-2">Edad Máxima <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="edad_max" id="edad_max" class="form-control required">
                                <option value="0">Seleccione</option>
                                @while($i<=85)
                                    @if($i==$query->age_max)
                                        <option value="{{$i}}" selected>{{$i}}</option>
                                    @else
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endif
                                    @var $i=$i+1;
                                @endwhile
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Monto Minimo <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="monto_min" id="monto_min" class="form-control required number" value="{{$query->amount_min}}" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Monto Máximo <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="monto_max" id="monto_max" class="form-control required number" value="{{$query->amount_max}}" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Numero Titulares <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="num_titu" id="num_titu" class="form-control required number" value="{{$query->detail}}" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Caducidad Cotizacion <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="caduc" id="caduc" class="form-control required number" value="{{$query->expiration}}" autocomplete="off">
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{route('admin.de.parameters.list-parameter-additional', ['nav'=>'de', 'action'=>'list_parameter_additional', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-primary">
                        Cancelar <i class="icon-cross position-right"></i>
                    </a>
                    <input type="hidden" name="id_product_parameter" id="id_product_parameter" value="{{$id_product_parameters}}">
                    <input type="hidden" name="id_retailer_product" id="id_retailer_product" value="{{$id_retailer_product}}">
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //VERIFICAMOS EL FORMULARIO
            $('#ParameterForm').submit(function(e){
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