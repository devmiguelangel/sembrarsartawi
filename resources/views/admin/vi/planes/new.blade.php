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
                <!--
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
                -->
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'create_plans_vi', 'name' => 'CreateForm', 'id' => 'CreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Producto</label>
                    <div class="col-lg-10">
                        <strong>{{$query_retailer->product}}</strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Nombre <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required text" name="txtName" id="txtName">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Descripcion </label>
                    <div class="col-lg-10">
                        <textarea rows="1" cols="5" class="form-control summernote" name="txtDesc" id="txtDesc"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Prima Mensual (Bs.) <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required number" name="txtPrimaM" id="txtPrimaM">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Prima Anual (Bs.) <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required number" name="txtPrimaA" id="txtPrimaA">
                    </div>
                </div>

            </fieldset>

            <fieldset class="content-group">

                <legend class="text-bold">Planes <span class="text-danger">*</span></legend>

                <div class="form-group">

                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-md-12">
                                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                    <tr>
                                        <td>
                                            <div class="form-group has-feedback">
                                                <textarea rows="1" cols="19" class="form-control required" name="txtOp1" id="txtOp1"></textarea>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control input-sm required number" name="txtBs1" id="txtBs1" placeholder="Bs.">
                                                <div class="form-control-feedback">
                                                    <i class="icon-cash3"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group has-feedback">
                                                <textarea rows="1" cols="19" class="form-control required" name="txtOp2" id="txtOp2"></textarea>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control input-sm required number" name="txtBs2" id="txtBs2" placeholder="Bs.">
                                                <div class="form-control-feedback">
                                                    <i class="icon-cash3"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group has-feedback">
                                                <textarea rows="1" cols="19" class="form-control required" name="txtOp3" id="txtOp3"></textarea>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control input-sm required number" name="txtBs3" id="txtBs3" placeholder="Bs.">
                                                <div class="form-control-feedback">
                                                    <i class="icon-cash3"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>

            <fieldset class="content-group">

                @var $j=18
                <div class="form-group">
                    <label class="control-label col-lg-2">Edad Mínima <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <select name="edad_min" id="edad_min" class="form-control required age">
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
                        <select name="edad_max" id="edad_max" class="form-control required age">
                            <option value="0">Seleccione</option>
                            @while($i<=85)
                                <option value="{{$i}}">{{$i}}</option>
                                @var $i=$i+1;
                            @endwhile
                        </select>
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{route('admin.vi.planes.list', ['nav'=>'listplansvi', 'action'=>'list', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>
                <input type="hidden" name="id_retailer_product" value="{{$id_retailer_product}}">
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //EDITOR DE TEXTO
            $('.summernote').summernote({
                height: 100,                 // set editor height

                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor

                focus: true                 // set focus to editable area after initializing summernote
            });

            //VERIFICAMOS EL FORMULARIO
            $('#CreateForm').submit(function(e){
                var sw = true;
                var err = 'Esta informacion es obligatoria';
                var age = new Array();
                $(this).find('.required, .not-required').each(function(index, element) {
                    //alert(element.type+'='+element.value);
                    if($(this).hasClass('required') === true){
                        if(validateElement(element,err) === false){
                            sw = false;
                        }else if(validateElementType(element,err) === false){
                            sw = false;
                        }else if($(this).hasClass('age') === true){
                            var  age_type = $(this).prop('id');
                            //alert(age_type);
                            //alert(age_type.indexOf('edad_min'));

                            if(age_type.indexOf('edad_min') == 0){
                                age[0] = $(this).prop('value');
                            }else if(age_type.indexOf('edad_max') == 0){
                                age[1] = $(this).prop('value');
                            }
                            //alert('age[0]:'+ age[0]);
                            //alert('age[1]:'+ age[1]);
                            if(age.length==2){
                                if(age[1]<age[0]){
                                    bootbox.alert("Error!! La edad minima debe ser menor a la edad maxima");
                                    sw = false;
                                }
                            }

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
                var _name = $(element).prop('name');
                //alert(_name);
                if(_type=='select-one'){
                    if(_value==0){
                        addClassE(element,err);
                        return false;
                    }else{
                        removeClassE(element,err);
                        return true;
                    }
                }else if(_type=='radio'){
                    var rd_val = $("input[name=" + _name + "]:radio").is(':checked');
                    //alert(rd_val);
                    if(rd_val === false){
                        $('#error-increment').html(err);
                        return false;
                    }else{
                        $('#error-increment').html('');
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