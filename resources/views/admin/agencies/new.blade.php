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
            <!--
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
            -->
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'create_agency', 'name' => 'AgencyCreateForm', 'id' => 'AgencyCreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Agencia <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required text" id="txtAgencia" name="txtAgencia" value="" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Codigo <span class="text-danger">*</span></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control required" id="txtCodigo" name="txtCodigo", value="" autocomplete="off">
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{ route('admin.agencies.list', ['nav'=>'agency', 'action'=>'list']) }}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        //VERIFICAMOS EL FORMULARIO
        $('#AgencyCreateForm').submit(function(e){
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
                regex = /^[0-9a-zA-ZáÁéÉíÍóÓúÚñÑüÜ\s\.\()\-]*$/;
                err = 'Ingrese solo texto';
            }else if($(element).hasClass('email') === true){
                regex = /^([a-z]+[a-z0-9._-]*)@{1}([a-z0-9\.]{2,})\.([a-z]{2,3})$/;
                err = 'Email invalido';
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
    </script>
@endsection