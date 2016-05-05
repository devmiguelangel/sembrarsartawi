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
                <small class="display-block">Nuevo registro</small>
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

            {!! Form::open(array('route' => 'new_addproductretailer', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer</label>
                        <div class="col-lg-10">
                            <select name="id_retailer" id="id_retailer" class="form-control required">
                                <option value="0">Seleccione</option>
                                @foreach($query_ret as $data_ret)
                                    <option value="{{$data_ret->id}}">{{$data_ret->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Producto</label>
                        <div class="col-lg-10">
                            <select name="id_company_products" id="id_company_products" class="form-control required" disabled>
                                <option value="0">Seleccione</option>
                                @foreach($query_pr_co as $data_pro)
                                    <option value="{{$data_pro->id_company_products}}">{{$data_pro->product}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Tipo Producto</label>
                        <div class="col-lg-10">
                            <select name="tipo_prod" id="tipo_prod" class="form-control required" disabled>
                                <option value="0">Seleccione</option>
                                @foreach(config('base.retailer_product_types') as $key=>$data_type)
                                    <option value="{{$key}}">{{$data_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary" disabled>
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{route('admin.addtoretailer.list', ['nav'=>'addtoretailer', 'action'=>'list', 'id_company'=>$id_company])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                    <input type="hidden" name="id_company" id="id_company" value="{{$id_company}}">
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#id_retailer').change(function(){
                var id_retailer = $(this).prop('value');
                if(id_retailer!=0){
                    $('#id_company_products').prop('disabled', false);
                    $('#tipo_prod').prop('disabled', false);
                    $('button[type="submit"]').prop('disabled', false);
                }else{
                    $('#id_company_products').prop('disabled', true);
                    $('#tipo_prod').prop('disabled', true);
                    $('button[type="submit"]').prop('disabled', true);
                }
            });

            $('#id_company_products').change(function(){
                var id_company_product = $(this).prop('value');
                var id_retailer = $('#id_retailer option:selected').prop('value');
                //alert(id_retailer);
                if(id_company_product!=0){
                    $.get( "{{url('/')}}/admin/addtoretailer/quest_ajax/"+id_company_product+"/"+id_retailer, function( data ) {
                        //console.log(data);
                        if(data==1){
                            if($("#id_company_products + .validation-error-label").length) {
                                $("#id_company_products + .validation-error-label").remove();
                            }
                            $('button[type="submit"]').prop('disabled', true);
                            if(!$("#id_company_products + .validation-error-label").length) {
                                $("#id_company_products:last").after('<span class="validation-error-label">El Producto ya esta agregado al Retailer o el producto agregado a la compañia no esta activado</span>');
                            }
                        }else if(data==0){
                            if($("#id_company_products + .validation-error-label").length) {
                                $("#id_company_products + .validation-error-label").remove();
                            }
                            $('button[type="submit"]').prop('disabled', false);
                        }
                    });
                }else{
                    if($("#id_company_products + .validation-error-label").length) {
                        $("#id_company_products + .validation-error-label").remove();
                    }
                    $('button[type="submit"]').prop('disabled', false);
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