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
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.email.new-email', ['nav'=>'email', 'action'=>'new_email'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Crear correo</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'new_add_email', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">


                    <div class="form-group">
                        <label class="control-label col-lg-2">Productos <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="id_product_retail" id="id_product_retail" class="form-control">
                                <option value="0">Seleccione</option>
                                @foreach($query as $data)
                                    <option value="{{$data->id_retailer_product}}">{{$data->product}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Correos electronicos <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="id_email" id="id_email" class="form-control" disabled>
                                <option value="0">Seleccione</option>
                                @foreach($query_email as $data_email)
                                    <option value="{{$data_email->id}}">{{$data_email->name}} - {{$data_email->email}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary" disabled>Guardar <i class="icon-floppy-disk position-right"></i></button>
                    <a href="{{route('admin.email.list-email-product-retailer', ['nav'=>'email', 'action'=>'list_epr'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //HABILITAR/DESABILITAR CAMPOS
            $('#id_product_retail').change(function(){
                var _id = $(this).prop('value');
                if(_id!=0){
                    $('#id_email').prop('disabled', false);
                    $('button[type="submit"]').prop('disabled', false);
                    if($("#id_email + .validation-error-label").length) {
                        $("#id_email + .validation-error-label").remove();
                    }
                    $('#id_email option[value="0"]').prop('selected',true);
                }else{
                    $('#id_email').prop('disabled', true);
                    $('button[type="submit"]').prop('disabled', true);
                    $('#id_email option[value="0"]').prop('selected',true);
                }
            });

            //BUSQUEDA AJAX
            $('#id_email').change(function(e){
                var id_email = $(this).prop('value');
                var id_product_retailer = $('#id_product_retail option:selected').prop('value');
                if(id_product_retailer!=0){
                    $.get( "{{url('/')}}/admin/email/quest_ajax/"+id_email+"/"+id_product_retailer, function( data ) {
                        console.log(data);
                        if(data==1){
                            if($("#id_email + .validation-error-label").length) {
                                $("#id_email + .validation-error-label").remove();
                            }
                            $('button[type="submit"]').prop('disabled', true);
                            if(!$("#id_email + .validation-error-label").length) {
                                $("#id_email:last").after('<span class="validation-error-label">El correo ya esta agregado al producto, seleccione otro correo u otro producto caso contrario adicione un nuevo correo</span>');
                            }
                        }else if(data==0){
                            if($("#id_email + .validation-error-label").length) {
                                $("#id_email + .validation-error-label").remove();
                            }
                            $('button[type="submit"]').prop('disabled', false);
                        }
                    });
                }else{
                    if($("#id_email + .validation-error-label").length) {
                        $("#id_email + .validation-error-label").remove();
                    }
                    $('button[type="submit"]').prop('disabled', false);
                }

            });
        });
    </script>
@endsection