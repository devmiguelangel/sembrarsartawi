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
                <small class="display-block">Editar registro</small>
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
@if($code_product=='vi')
    @var $class_input='form-control required number'
    @var $hide = ''
@else
    @var $class_input=''
    @var $hide = 'display: none;'
@endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'update_policy', 'name' => 'UpdateForm', 'id' => 'UpdateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Producto <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <strong>{{$query_prod->product}}</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Numero de Póliza <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="txtNumPoliza" id="txtNumPoliza" value="{{$query_policy->number}}" class="form-control required alphanumeric">
                        </div>
                    </div>

                    @if($code_product=='au' || $code_product=='td')
                        <div class="form-group">
                            <label class="control-label col-lg-2">Moneda <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <select name="moneda" id="moneda" class="form-control required">
                                    <option value="0">Seleccione</option>
                                    <option value="BS"
                                    @if($query_policy->currency=='BS')
                                            selected
                                            @endif
                                            >Bolivianos</option>
                                    <option value="USD"
                                    @if($query_policy->currency=='USD')
                                            selected
                                            @endif
                                            >Dolares</option>
                                </select>
                            </div>
                        </div>
                    @elseif($code_product=='de')
                        @var $parameter_tp = config('base.policy_types');
                        <div class="form-group">
                            <label class="control-label col-lg-2">Tipo Poliza<span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <select name="tipo" id="tipo" class="form-control required">
                                    <option value="0">Seleccione</option>
                                    @foreach($parameter_tp as $key=>$data)
                                        @if($query_policy->type==$key)
                                            <option value="{{$key}}" selected>{{$data}}</option>
                                        @else
                                            <option value="{{$key}}">{{$data}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="form-group" style="{{$hide}}">
                        <label class="control-label col-lg-2">Póliza Final <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="txtEndPoliza" id="txtEndPoliza" value="{{$query_policy->end_policy}}" class="{{$class_input}}">
                        </div>
                    </div>

                    <div class="form-group" style="{{$hide}}">
                        <label class="control-label col-lg-2">Auto Incremento</label>
                        <label class="radio-inline">
                            @if((boolean)$query_policy->auto_increment==true)
                                <input type="radio" name="auto_inc" class="styled" checked="checked" value="1">SI
                            @else
                                <input type="radio" name="auto_inc" class="styled" value="1">SI
                            @endif
                        </label>

                        <label class="radio-inline">
                            @if((boolean)$query_policy->auto_increment==false)
                                <input type="radio" name="auto_inc" class="styled" checked="checked" value="0">NO
                            @else
                                <input type="radio" name="auto_inc" class="styled" value="0">NO
                            @endif
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Fecha Inicial <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                <input type="text" class="form-control pickadate-cobodate required" name="fechaini" id="fechaini" value="{{$query_policy->date_begin}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Fecha Final <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                <input type="text" class="form-control pickadate-cobodate" name="fechafin" id="fechafin" value="{{$query_policy->date_end}}">
                            </div>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{route('admin.policy.list', ['nav'=>'policy', 'action'=>'list', 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                    <input type="hidden" name="id_policies" id="id_policies" value="{{$id_policies}}">
                    <input type="hidden" name="id_retailer_products" id="id_retailer_products", value="{{$id_retailer_products}}">
                    <input type="hidden" name="code_product" id="code_product" value="{{$code_product}}">
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
                }else if($(element).hasClass('alphanumeric') === true){
                    regex = /^([0-9A-Z\-])*$/;
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