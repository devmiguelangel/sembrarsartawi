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
                Formulario Producto {{$retailer_product_query->companyProduct->product->name}}
                <small class="display-block">Nuevo registro </small>
            </h5>
            <div class="heading-elements">
                <!--
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
                -->
            </div>
        </div>
        @include('admin.partials.message')
        <div class="panel-body">

            {!! Form::open(array('route' => 'create_mr_parameter', 'name' => 'CreateForm', 'id' => 'CreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Producto Parametro <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <select name="prod_param" id="prod_param" class="form-control required">
                            <option value="0">Seleccione</option>
                            @foreach(config('base.product_parameters') as $key=>$data)
                                <option value="{{$key}}">{{$data}}</option>
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
                                <option value="{{$j}}">{{$j}}</option>
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
                                <option value="{{$i}}">{{$i}}</option>
                                @var $i=$i+1;
                            @endwhile
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Monto Minimo (USD)<span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" name="monto_min" id="monto_min" class="form-control required number" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Monto Máximo (USD)<span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" name="monto_max" id="monto_max" class="form-control required number" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Cantidad de Registros <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" name="cantidad" id="cantidad" class="form-control required number" maxlength="2" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Caducidad Cotización <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" name="caduc" id="caduc" class="form-control required number" maxlength="3" autocomplete="off">
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>

                <a href="{{route('admin.td.parameters.list-parameter-additional', ['nav'=>'mr_parameter', 'action'=>'list_parameter_additional', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>
                <input type="hidden" name="id_retailer_product" id="id_retailer_product" value="{{$id_retailer_product}}">
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
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