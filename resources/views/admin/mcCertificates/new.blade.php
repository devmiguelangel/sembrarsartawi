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
        <h5 class="panel-title"><i class="icon-plus2"></i> Nuevo registro</h5>
        <hr />
    </div>
    <div class="panel-body">
        {!! Form::open(array('route' => 'create_mc_certificates', 'name' => 'Form', 'id' => 'mc_certificates', 'method'=>'post', 'class'=>'form-horizontal form-validate-jquery')) !!}
        <fieldset class="content-group">
            
            <div class="form-group">
                <label class="col-lg-2 control-label label_required">Tipo certificado: </label>
                <div class="col-lg-5">
                    <select name="ad_retailer_product_id" class="form-control" id="ad_retailer_product_id" required="required">
                        <option value="">Seleccione</option>
                        @foreach($retailerProd as $retailerProduct)
                        <option value="{{ $retailerProduct->id }}">{{ $retailerProduct->name_product }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label label_required">Tipo certificado: </label>
                <div class="col-lg-5">
                    <select name="type" class="form-control" id="type" required="required">
                        <option value="">Seleccione</option>
                        @foreach($type as $type_campo)
                        <option value="{{ $type_campo['key'] }}">{{ $type_campo['value'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2 label_required">Nombre certificado</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-text-width"></i></span>
                        <input type="text" placeholder="Pregunta" class="form-control" name="name" id="name" required="required">
                    </div>
                </div>
            </div>
            <hr />
            <div class="form-group">
                <label class="radio-inline radio-right">
                    <input type="radio" value="1" checked="checked" name="active">
                    Activar
                </label>

                <label class="radio-inline radio-right">
                    <input type="radio" value="0" name="active">
                    Desactivar
                </label>
            </div>
        </fieldset>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">
                Guardar <i class="icon-floppy-disk position-right"></i>
            </button>
            <a href="{{ route('mcCertificatesList') }}" class="btn btn-danger">
                Cancelar <i class="icon-arrow-right14 position-right"></i>
            </a>
        </div>
        {!!Form::close()!!}
    </div>
</div>
@endsection