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
    <!-- Select2 sizing -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="form-wizard-title text-semibold" style="border-bottom: 0px;">
                <span class="form-wizard-count"><i class="icon-file-text2"></i></span>
                Productos y Subproductos
                <small class="display-block">Agregar Subproductos</small>
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
        @if($id_retailer_product_select>0)
            @var $disabled=''
        @else
            @var $disabled='disabled'
        @endif
        <div class="panel-body">
            {!! Form::open(array('route' => 'add_subproduct', 'name' => 'CreateForm', 'id' => 'CreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}

                <fieldset class="content-group">

                    <div class="col-md-6">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Productos</h5>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    @if(count($product)>0)
                                        <select name="id_retailer_product" id="id_retailer_product" class="form-control required">
                                        <option value="0">Seleccione</option>
                                        @foreach($product as $value_pr)
                                            @var $vec = explode('|',$value_pr)
                                            @var $id_retailer_product = $vec[0]
                                            @var $product = $vec[1]
                                            @if($id_retailer_product_select==$id_retailer_product)
                                                <option value="{{$id_retailer_product}}" selected>{{$product}}</option>
                                            @else
                                                <option value="{{$id_retailer_product}}">{{$product}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @else
                                        <div class="alert alert-warning alert-styled-left">
                                            <span class="text-semibold">Warning!</span> No existe ningun subproducto, ingrese un nuevo subproducto.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Subproductos</h5>
                            </div>
                            @var $dt_var = 0
                            <div class="panel-body">
                                <div class="form-group">
                                    @if(count($subproduct)>0)
                                        <select multiple="multiple" class="form-control required" name="subproduct[]" id="subproduct" {{$disabled}}>
                                        @foreach($subproduct as $value_sp)
                                            @var $vec = explode('|',$value_sp)
                                            @var $id_company_product = $vec[0]
                                            @var $product = $vec[1]
                                            @if(count($retailer_subproduct)>0)
                                                @foreach($retailer_subproduct as $data)
                                                    @if($id_company_product==$data->ad_company_product_id)
                                                        <option value="{{$id_company_product}}" selected>{{$product}}</option>
                                                        @var $dt_var=$id_company_product
                                                    @endif
                                                @endforeach
                                                @if($id_company_product!=$dt_var)
                                                        <option value="{{$id_company_product}}">{{$product}}</option>
                                                @endif
                                            @else
                                                <option value="{{$id_company_product}}">{{$product}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                </div>
            {!!Form::close()!!}
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            //VISUALIZAR SUBPRODUCTOS Y FERIFICAR SI ESTAN ADICIONADOS A UN PRODUCTO
            $('#id_retailer_product').change(function(e){
                var id_retailer_product = $(this).prop('value');
                //alert(id_retailer_product);
                if(id_retailer_product!=0){
                    var retprod;
                    var retsubp;
                    var sw=0;
                    $('#subproduct').prop('disabled',false);
                    $.get( "{{url('/')}}/admin/subproduct/subprod_ajax/"+id_retailer_product, function( json ) {
                        console.log(json);
                        $('#subproduct option').remove();
                        $.each(json, function (key, data) {
                            console.log(key)
                            if(key=='retpr'){
                                retprod=data;
                            }else if(key=='retsp'){
                                retsubp = data;
                            }
                        });
                        $.each(retprod, function () {
                            console.log("ID: " + this.ad_company_product_id);
                            console.log("Profiles: " + this.product);
                            var ad_company_product_id = this.ad_company_product_id;
                            var product = this.product;
                            $.each(retsubp, function () {
                                var id_company_subprod = this.id_company_subprod;
                                if(ad_company_product_id==id_company_subprod){
                                    $('#subproduct').append('<option value="'+ad_company_product_id+'" selected>'+product+'</option>');
                                    sw=ad_company_product_id;
                                }
                            });
                            if(ad_company_product_id!=sw){
                                $('#subproduct').append('<option value="'+ad_company_product_id+'">'+product+'</option>');
                            }
                        });

                    });
                }else{
                    $("#subproduct option:selected").removeAttr("selected");
                    $('#subproduct').prop('disabled',true);
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
                        }else if($(this).hasClass('age') === true){
                            var  age_type = $(this).prop('id');
                            if(age_type.indexOf('edad_min') > -1){
                                age[0] = $(this).prop('value');
                            }else if(age_type.indexOf('edad_max') > -1){
                                age[1] = $(this).prop('value');
                            }
                            if(age.length==2){
                                if(age[1]<age[0]){
                                    bootbox.alert("Error!! La edad minima debe ser menor a la edad maxima");
                                    sw = false;
                                }else{
                                    sw = true;
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
    <!-- /select2 sizing -->
@endsection