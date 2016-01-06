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
            <h5 class="panel-title">Formulario crear registro</h5>
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

        <div class="panel-body">

            {!! Form::open(array('route' => 'create_agency', 'name' => 'AgencyCreateForm', 'id' => 'AgencyCreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Agencia</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="txtAgencia" name="txtAgencia" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Codigo</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="txtCodigo" name="txtCodigo", value="">
                    </div>
                </div>

            </fieldset>

            <fieldset class="content-group">
                <h5 class="panel-title">Agregar agencia a departamento Retailer</h5>
                <br>
                <div class="form-group">
                    <label class="control-label col-lg-2">Retailer</label>
                    <div class="col-lg-10">
                        {{$query_re->name}}
                        <input type="hidden" id="id_retailer" name="id_retailer" value="{{$query_re->id}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Departamento</label>
                    <div class="col-lg-10">
                        <select name="id_retailer_city" id="id_retailer_city" class="form-control">
                            <option value="0">Ninguno</option>
                            @foreach($query_dp as $data)
                                <option value="{{$data->id_retailer_city}}">{{$data->departamento}}</option>
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
@endsection