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

            {!! Form::open(array('route' => 'new_modality', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Modalidad <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="id_modality" id="id_modality" class="form-control required">
                                <option value="0">Seleccione</option>
                                @foreach(config('base.sp_modalities') as $key=>$data)
                                    <option value="{{$key}}">{{$data}}</option>
                                @endforeach
                            </select>
                            <div id="msg_error"></div>
                        </div>
                    </div>

                    <div class="form-group" id="content-rank-min" style="display: none;">
                        <label class="control-label col-lg-2">Rango Mínimo (Bs.) <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="rank-min" id="rank-min" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group" id="content-rank-max" style="display:none;">
                        <label class="control-label col-lg-2">Rango Máximo (Bs.) <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="rank-max" id="rank-max" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Monto Asegurado (Bs.) <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required" name="amount" id="amount" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Monto Mínimo (Bs.) <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required" name="amount-min" id="amount-min" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Monto Máximo (Bs.) <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required" name="amount-max" id="amount-max" autocomplete="off">
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Guardar <i class="icon-floppy-disk position-right"></i></button>

                    <a href="{{route('admin.vi.modality.list', ['nav'=>'modality', 'action'=>'list', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-primary">
                        Cancelar <i class="icon-cross position-right"></i>
                    </a>
                    <input type="hidden" name="id_retailer_product" value="{{$id_retailer_product}}">
                    <input type="hidden" name="active" id="active">
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //SELECCIONAMOS LA MODALIDAD
            $('#id_modality').change(function(e){
                var id_modality = $(this).prop('value');
                //alert(id_modality);
                if(id_modality!=0){
                    if(id_modality=='MS'){
                        $('#content-rank-min').fadeOut('fast');
                        $('#content-rank-max').fadeOut('fast');
                        $('#rank-min').removeClass('form-control required');
                        $('#rank-max').removeClass('form-control required');

                        $.get( "{{url('/')}}/admin/vi/modality/modality_ajax/"+id_modality, function( data ) {
                            console.log(data);
                            var arr = data.split('|');
                            if(arr[0]==0){
                                $('#active').prop('value',0);
                            }else if(arr[0]==1){
                                 $('button[type="submit"]').prop('disabled', true);
                                 $('#rate_final').prop('disabled', true);
                                 $('#msg_error').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span>Esta modalidad solo puede ser registrada una sola vez</div>');
                                 $('#amount, #amount-min, #amount-max').prop('disabled', true);
                                 $('#active').prop('value',arr[1]);
                            }
                        });

                    }else if(id_modality=='MV'){
                        $('#amount, #amount-min, #amount-max').prop('disabled', false);
                        $('button[type="submit"]').prop('disabled', false);
                        $('#msg_error').html('');
                        $('#content-rank-min').fadeIn('fast');
                        $('#content-rank-max').fadeIn('fast');
                        $('#rank-min').addClass('form-control required');
                        $('#rank-max').addClass('form-control required');
                        $.get( "{{url('/')}}/admin/vi/modality/modality_ajax/"+id_modality, function( data ) {
                            console.log(data);
                            var arr = data.split('|');
                            if(arr[0]==0){
                                $('#active').prop('value',0);
                            }else if(arr[0]==1){
                                $('#amount-min').prop('value',arr[1]);
                                $('#amount-min').prop('readonly',true);
                                $('#amount-max').prop('value',arr[2]);
                                $('#amount-max').prop('readonly',true);
                                $('#active').prop('value',arr[3]);
                                /*$('button[type="submit"]').prop('disabled', true);
                                $('#rate_final').prop('disabled', true);
                                $('#msg_error').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span>Esta modalidad solo puede ser registrada una sola vez</div>');
                                $('#amount, #amount-min, #amount-max').prop('disabled', true);*/
                            }
                        });
                    }
                }else{
                    $('#content-rank-min').fadeOut('fast');
                    $('#content-rank-max').fadeOut('fast');
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