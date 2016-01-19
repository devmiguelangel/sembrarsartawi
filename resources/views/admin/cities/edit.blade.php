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

            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'update_city', 'name' => 'CityUpdateForm', 'id' => 'CityUpdateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Departamento/Sucursal</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="txtSucursal" name="txtSucursal" value="{{$query->name}}" maxlength="100">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Código</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" value="{{$query->abbreviation}}" maxlength="3">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Agregar a Retailer</label>
                        <div class="col-lg-10">
                            <select name="id_retailer" id="id_retailer" class="form-control required">
                                <option value="0">Ninguno</option>
                                @foreach($query_re as $data)
                                    @if(count($query_ret_city)>0)
                                        @foreach($query_ret_city as $data_city)
                                            @if($data_city->ad_city_id==$data->id)
                                                <option value="{{$data->id}}" selected>{{$data->name}}</option>
                                            @else
                                                <option value="{{$data->id}}">{{$data->name}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-arrow-right14 position-right"></i>
                    </button>
                    <input type="hidden" id="id_depto" name="id_depto" value="{{$query->id}}">
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