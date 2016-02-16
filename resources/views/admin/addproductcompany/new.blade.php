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
            <h5 class="panel-title">Formulario agregar producto</h5>
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

        <div class="panel-body">

            {!! Form::open(array('route' => 'new_addproduct', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Compañía</label>
                        <div class="col-lg-10">
                            {{$query_cia->name}}
                            <input type="hidden" name="id_company" id="id_company" value="{{$id_company}}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Productos</label>
                        <div class="col-lg-10">
                            @if(count($query_prod)>0)
                                <select name="id_product" id="id_product" class="form-control required">
                                    <option value="0">Seleccione</option>
                                    @foreach($query_prod as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-info alert-styled-left alert-bordered">
                                    <span class="text-semibold">Alert</span> No existe ningun producto, ingrese un nuevo producto.
                                </div>
                            @endif
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    @if(count($query_prod)>0)
                        <button type="submit" class="btn btn-primary">
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary" disabled>
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @endif
                    <a href="{{route('admin.addproductcompany.list', ['nav'=>'company', 'action'=>'list', 'id_company'=>$id_company])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
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
                }else if($(element).hasClass('dominio') === true){
                    regex = /^([a-z])*$/;
                    err = 'Ingrese solo letras minusculas';
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