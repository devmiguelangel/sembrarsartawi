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
                        @if(count($query_dp)>0)
                            <select name="id_retailer_city" id="id_retailer_city" class="form-control">
                                <option value="0">Ninguno</option>
                                @foreach($query_dp as $data)
                                    <option value="{{$data->id_retailer_city}}">{{$data->departamento}}</option>
                                @endforeach
                            </select>
                        @else
                            <div class="alert alert-info alert-styled-left alert-bordered">
                                <span class="text-semibold">Alert</span> No existe departamento asignados a Retailer.
                            </div>
                        @endif
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{ route('admin.agencies.list', ['nav'=>'agency', 'action'=>'list', 'id_retailer'=>auth()->user()->retailer->first()->id]) }}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
@endsection