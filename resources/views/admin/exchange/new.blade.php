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
    <!-- Form horizontal -->
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
                    <li><a data-action="reload"></a></li>
                </ul>
                -->
            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'create_exchange', 'name' => 'exchangeForm', 'id' => 'exchangeForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Entidad Financiera</label>
                        <div class="col-lg-10">
                            {{$retailer->name}}
                            <input type="hidden" class="form-control" name="id_retailer" id="id_retailer" value="{{$retailer->id}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Valor USD</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required" name="valor_usd" id="valor_usd" value="1" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Valor Bs</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required real" id="valor_bs" name="valor_bs">
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{route('admin.exchange.list', ['nav'=>'exchange', 'action'=>'list'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){

            //VERIFICAMOS EL FORMULARIO
            $('#exchangeForm').submit(function(e){
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
                if(!$("#"+_id+" + .msg-form").length) {
                    $("#"+_id+":last").after('<span class="msg-form">'+err+'</span>');
                }
            }
            //REMOVEMOS CLASE
            function removeClassE(element){
                var _id = $(element).prop('id');
                //$(element).removeClass('error-text');
                if($("#"+_id+" + .msg-form").length) {
                    $("#"+_id+" + .msg-form").remove();
                }
            }
            //VALIDAR TIPO DE ELEMENTO
            function validateElementType(element,err){
                var _value = $(element).prop('value');
                var regex = null;
                if($(element).hasClass('number') === true){
                    regex = /^([0-9])*$/;
                    err = 'Ingrese solo numeros';
                }else if($(element).hasClass('real') === true){
                    regex = /^([0-9])*[.]?[0-9]*$/;
                    err = 'Ingrese solo numeros.';
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
    <!-- /form horizontal -->
@endsection