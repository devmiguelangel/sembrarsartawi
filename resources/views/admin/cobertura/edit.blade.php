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
                Editar datos Cobertura
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
        <div class="panel-body">

            {!! Form::open(array('route' => 'update_coverage', 'name' => 'UpdateForm', 'id' => 'UpdateForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Retailer</label>
                    <div class="col-lg-10">
                        <strong>{{$query->retailer}}</strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Producto</label>
                    <div class="col-lg-10">
                        <strong>{{$query->product}}</strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Cobertura</label>
                    <div class="col-lg-10">
                        <strong>{{$query->coverage}}</strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Numero de Titulares</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required number" name="num_titulares" id="num_titulares" maxlength="3" value="{{$query->num_holder}}" autocomplete="off">
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{route('admin.cobertura.list', ['nav'=>'coverage', 'action'=>'list'])}}" class="btn btn-primary">
                    Cancelar <i class="icon-arrow-right14 position-right"></i>
                </a>
                <input type="hidden" name="id_retailer_product_coverage" value="{{$id_retailer_product_coverage}}">
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