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
                Nuevo Registro agregar tasas producto {{$product_query->name}}
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
        @var $cont = 0
        <div class="panel-body">

            {!! Form::open(array('route' => 'new_rates', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
                @if($code_product=='de' || $code_product=='vi' || $code_product=='mr')
                    <fieldset class="content-group">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Retailer <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                @if(count($retailer)>0)
                                    <select name="id_retailer" id="id_retailer" class="form-control required">
                                        <option value="0">Seleccione</option>
                                        @foreach($retailer as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="alert alert-warning alert-styled-left">
                                        <span class="text-semibold"></span>No existe Retailer registrado.<br>- El Retailer no esta activado
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Producto <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <select name="id_producto_retailer" id="id_producto_retailer" class="form-control required" disabled>
                                    <option value="0">Seleccione</option>
                                </select>
                                <div id="msg_error"></div>
                            </div>
                        </div>

                        <div class="form-group" id="content-coverage">
                            <label class="control-label col-lg-2">Coberturas <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <select name="id_coverage" id="id_coverage" class="form-control required" disabled>
                                    <option value="0">Seleccione</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="content-rate-company">
                            <label class="control-label col-lg-2">Tasa Compañía <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control required decimal" name="rate_company" id="rate_company" value="0" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group" id="content-rate-bank">
                            <label class="control-label col-lg-2">Tasa Banco <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control required decimal" name="rate_bank" id="rate_bank" value="0" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Tasa Final <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control required decimal" name="rate_final" id="rate_final" readonly value="0" autocomplete="off">
                            </div>
                        </div>

                    </fieldset>
                @elseif($code_product=='au')
                    <fieldset class="content-group">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Retailer <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                @if(count($retailer)>0)
                                    <select name="id_retailer" id="id_retailer" class="form-control required">
                                        <option value="0">Seleccione</option>
                                        @foreach($retailer as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="alert alert-warning alert-styled-left">
                                        <span class="text-semibold"></span>No existe Retailer registrado.<br>- El Retailer no esta activado
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Producto <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <select name="id_producto_retailer" id="id_producto_retailer" class="form-control required" disabled>
                                    <option value="0">Seleccione</option>
                                </select>
                                <div id="msg_error"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Tasa Final <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control required decimal" name="rate_end" id="rate_end" value="0" autocomplete="off">
                            </div>
                        </div>
                        @if(count($category_query)>0)
                            @foreach($category_query as $data)
                                @var $cont=$cont+1
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Tasa Categoria {{substr($data->category, 1)}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control required decimal category" name="rate_category_{{$cont}}" id="rate_category_{{$cont}}" value="0" autocomplete="off" rel="{{$cont}}">
                                        <input type="hidden" name="category-{{$cont}}" value="{{$data->id}}">
                                    </div>
                                </div>
                            @endforeach
                            <input type="hidden" name="cont" value="{{$cont}}">
                        @else
                            <div class="alert alert-warning alert-styled-left">
                                <span class="text-semibold"></span> No existe ninguna categoria registrada, ingrese una nueva categoria <a href="{{route('admin.au.increment.new', ['nav'=>'au_increment', 'action'=>'new', 'id_retailer_products'=>$id_retailer_products])}}">clic aqui</a>

                            </div>
                        @endif
                    </fieldset>
                @endif

                <div class="text-right">
                    @if(count($category_query)>0)
                        <button type="submit" class="btn btn-primary">
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary" disabled>
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @endif
                    <a href="{{route('admin.tasas.list', ['nav'=>'rate', 'action'=>'list', 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                    <input type="hidden" id="id_retailer_products" name="id_retailer_products" value="{{$id_retailer_products}}">
                    <input type="hidden" name="code_product" value="{{$code_product}}">
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //BUSCAMOS LOS PRODUCTOS AGREGADOS AL RETAILER
            $('#id_retailer').change(function(e) {
                var  id_retailer = $(this).prop('value');
                var id_retailer_product = $('#id_retailer_products').prop('value');
                //alert(id_retailer_product);
                $.get( "{{url('/')}}/admin/tasas/product_retailer_ajax/"+id_retailer+"/"+id_retailer_product, function( data ) {
                    //console.log(data);
                    if(data.length>0) {
                        $('button[type="submit"]').prop('disabled', false);
                        $('#id_producto_retailer').prop('disabled', false);
                        $('#id_producto_retailer option').remove();
                        $('#id_producto_retailer').append('<option value="0">Seleccione</option>');
                        $('#msg_error').html('');
                        $.each(data, function () {
                            //console.log("ID: " + this.id_retailer_product);
                            //console.log("First Name: " + this.product);
                            //console.log("code: "+ this.code);
                            $('#id_producto_retailer').append('<option value="'+this.id_retailer_product+'|'+this.code+'">'+this.product+'</option>');
                        });
                    }else{
                        $('#id_retailer option[value="0"]').prop('selected',true);
                        $('button[type="submit"]').prop('disabled', true);
                        $('#msg_error').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span> - No existen productos agregados a un Retailer.<br>- No Existen productos humanitarios</div>');
                    }
                });
            });

            //VERIFICAMOS LAS COBERTURAS EXISTENTES
            $('#id_producto_retailer').change(function(e){
                var _id = $(this).prop('value');
                var arr = _id.split('|');
                var id_retailer_product = arr[0];
                var code = arr[1];
                //alert(id_retailer_product);
                if(id_retailer_product!=0){
                    if(code=='de' || code=='mr'){
                        $('#content-coverage').fadeOut('fast');
                        $('#id_coverage').removeClass('form-control required').addClass('form-control not-required');
                        $('#content-rate-company').fadeOut('fast');
                        $('#rate_company').removeClass('form-control required decimal').addClass('form-control not-required decimal');
                        $('#content-rate-bank').fadeOut('fast');
                        $('#rate_bank').removeClass('form-control required decimal').addClass('form-control not-required decimal');
                        $('#rate_final').removeClass('form-control required decimal').addClass('form-control not-required decimal').prop('readonly',false);
                        $.get( "{{url('/')}}/admin/tasas/quest_rate_ajax/"+id_retailer_product, function( data ) {
                            if(data==1){
                                $('button[type="submit"]').prop('disabled', true);
                                $('#rate_final').prop('disabled', true);
                                $('#msg_error').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span>El producto ya tiene registrado la tasa</div>');
                            }else{
                                $('button[type="submit"]').prop('disabled', false);
                                $('#rate_final').prop('disabled', false);
                                $('#msg_error').html('');
                            }
                        });
                        /*
                        $.get( "{{url('/')}}/admin/tasas/cobertura_ajax/"+id_retailer_product, function( data ) {
                            console.log(data);

                            if(data.length>0) {
                                $('button[type="submit"]').prop('disabled', false);
                                $('#id_coverage').prop('disabled', false);
                                $('#id_coverage option').remove();
                                $('#id_coverage').append('<option value="0">Seleccione</option>');
                                $('#msg_error').html('');
                                $.each(data, function () {
                                    console.log("ID: " + this.id_coverage);
                                    console.log("First Name: " + this.coverage);
                                    $('#id_coverage').append('<option value="'+this.id_coverage+'">'+this.coverage+'</option>');
                                });
                            }else{
                                $('#id_coverage option').remove();
                                $('#id_coverage').append('<option value="0">Seleccione</option>');
                                $('button[type="submit"]').prop('disabled', true);
                                $('#msg_error').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span>Las coberturas ya tienen registrados las tasas o no existen coberturas registradas a producto</div>');
                            }

                        });
                        */
                    }else if(code=='vi'){
                        $('button[type="submit"]').prop('disabled', false);
                        $('#content-coverage').fadeOut('fast');
                        $('#id_coverage').removeClass('form-control required');
                        $('#content-rate-company').fadeOut('fast');
                        $('#rate_company').removeClass('form-control required decimal');
                        $('#content-rate-bank').fadeOut('fast');
                        $('#rate_bank').removeClass('form-control required decimal');
                        $('#msg_error').html('');
                        $('#rate_final').prop('readonly',false);
                        $.get( "{{url('/')}}/admin/tasas/quest_rate_ajax/"+id_retailer_product, function( data ) {
                            if(data==1){
                                $('button[type="submit"]').prop('disabled', true);
                                $('#rate_final').prop('disabled', true);
                                $('#msg_error').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span>El producto ya tiene registrado la tasa</div>');
                            }else{
                                $('button[type="submit"]').prop('disabled', false);
                                $('#rate_final').prop('disabled', false);
                                $('#msg_error').html('');
                            }
                        });
                    }else{
                        $('button[type="submit"]').prop('disabled', false);
                    }
                }else{

                }
            });

            //REALIZAR SUMAS DE TASAS PARA EL RESULTADO TASA FINAL
            $('#rate_company').click(function(){
                $('#rate_company').prop('value', '');
            });
            $('#rate_company').keyup(function(){
                var rate_company = $('#rate_company').prop('value');
                var regex = /^([0-9\.])*$/;
                if(!(regex.test(rate_company))){
                    $('#rate_company').prop('value', '');
                }else{
                    var rate_bank = $('#rate_bank').prop('value');
                    var tasa_final = parseFloat(rate_company)+ parseFloat(rate_bank);
                    if(isNaN(tasa_final)){
                        $('#rate_final').prop('value', 0);
                    }else{
                        $('#rate_final').prop('value',tasa_final.toFixed(2));
                    }
                }
            });

            $('#rate_bank').click(function(){
                $('#rate_bank').prop('value', '');
            });
            $('#rate_bank').keyup(function(){
                var rate_bank = $('#rate_bank').prop('value');
                var regex = /^([0-9\.])*$/;
                if(!(regex.test(rate_bank))){
                    $('#rate_bank').prop('value', '');
                }else{
                    var rate_company = $('#rate_company').prop('value');
                    var tasa_final = parseFloat(rate_company)+ parseFloat(rate_bank);
                    if(isNaN(tasa_final)){
                        $('#rate_final').prop('value', 0);
                    }else{
                        $('#rate_final').prop('value',tasa_final.toFixed(2));
                    }
                }
            });

            $('#rate_end').click(function(){
                $('#rate_end').prop('value', '');
            });
            $('#rate_end').keyup(function(){
                var rate_bank = $('#rate_end').prop('value');
                var regex = /^([0-9\.])*$/;
                if(!(regex.test(rate_bank))){
                    $('#rate_end').prop('value', '');
                }
            });

            $('.category').click(function(){
                var rel = $(this).attr('rel');
                $('#rate_category_'+rel).prop('value', '');
            });

            $('.category').keyup(function(){
                var rel = $(this).attr('rel');
                var rate = $('#rate_category_'+rel).prop('value');
                var regex = /^([0-9\.])*$/;
                if(!(regex.test(rate))){
                    $('#rate_category_'+rel).prop('value', '');
                }
            });


            //VERIFICAMOS EL FORMULARIO
            $('#NewForm').submit(function(e){
                var sw = true;
                var err = 'Esta informacion es obligatoria';
                var code_product = $("input[name='code_product']").prop('value');

                $(this).find('.required, .not-required').each(function(index, element) {
                    //alert(element.type+'='+element.value);
                    if($(this).hasClass('required') === true){
                        if(validateElement(element,err,code_product) === false){
                            sw = false;
                        }else if(validateElementType(element,err,code_product) === false){
                            sw = false;
                        }
                    }else if($(this).hasClass('not-required') === true){
                        removeClassE(element);
                        if(validateElementType(element,err,code_product) === false){
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
            function validateElement(element,err,code_product){
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
                    if(code_product=='au'){
                        if(_value==''){
                            addClassE(element,err);
                            return false;
                        }else{
                            removeClassE(element,err);
                            return true;
                        }
                    }else{
                        if(_value==0){
                            err = 'Ingrese una tasa';
                            addClassE(element,err);
                            return false;
                        }else{
                            removeClassE(element,err);
                            return true;
                        }
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