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
        <!--
        <div class="panel-heading">
            <h5 class="panel-title">Formulario resetear contraseña</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        -->
        <div class="panel-body">

            {!! Form::open(array('route' => 'create_city', 'name' => 'CityCreateForm', 'id' => 'CityCreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Departamento/Sucursal</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="txtSucursal" name="txtSucursal" value="" maxlength="100">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Código</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" value="" maxlength="3">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Agregar a Retailer</label>
                    <div class="col-lg-10">
                        <select name="id_retailer" id="id_retailer" class="form-control required">
                            <option value="0">Ninguno</option>
                            @foreach($query_re as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-arrow-right14 position-right"></i>
                </button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#txtCodigo').keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
@endsection