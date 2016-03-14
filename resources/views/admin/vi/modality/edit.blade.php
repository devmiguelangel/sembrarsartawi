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
                <small class="display-block">Nuevo registro </small>
            </h5>
            <div class="heading-elements">

            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'update_modality', 'name' => 'UpdateForm', 'id' => 'UpdateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Modalidad <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        @var $parameter = config('base.sp_modalities');
                        {{$parameter[$query_edit->modality]}}
                        <div id="msg_error"></div>
                    </div>
                </div>
                @if($query_edit->modality=='MV')
                    <div class="form-group">
                        <label class="control-label col-lg-2">Rango Mínimo (Bs.) <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required" name="rank-min" id="rank-min" autocomplete="off" value="{{$query_edit->rank_min}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Rango Máximo (Bs.) <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required" name="rank-max" id="rank-max" autocomplete="off" value="{{$query_edit->rank_max}}">
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-lg-2">Monto Asegurado (Bs.) <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required" name="amount" id="amount" autocomplete="off" value="{{$query_edit->amount}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Monto Mínimo (Bs.) <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required" name="amount-min" id="amount-min" autocomplete="off" value="{{$query_edit->amount_min}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Monto Máximo (Bs.) <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required" name="amount-max" id="amount-max" autocomplete="off" value="{{$query_edit->amount_max}}">
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Guardar <i class="icon-floppy-disk position-right"></i></button>

                <a href="{{route('admin.vi.modality.list', ['nav'=>'modality', 'action'=>'list', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>
                <input type="hidden" name="id_retailer_product" value="{{$id_retailer_product}}">
                <input type="hidden" name="modality_code" value="{{$query_edit->modality}}">
                <input type="hidden" name="id_modality" value="{{$id_modality}}">
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){

            //VERIFICAMOS EL FORMULARIO
            $('#UpdateForm').submit(function(e){
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
                    if(_value==0){
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
                }else if($(element).hasClass('decimal') === true){
                    regex = /^([0-9\.])*$/;
                    err = 'Ingrese solo numeros enteros o numeros decimales';
                }else if($(element).hasClass('numero') === true){
                    regex = /^([0-9])*$/;
                    err = 'Ingrese solo numeros enteros';
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