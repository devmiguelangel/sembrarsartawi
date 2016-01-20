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
        <h5 class="panel-title"><i class="icon-plus2"></i> Modificación - {{ $entity->name }}</h5>
        <hr />
    </div>
    <div class="panel-body">
        {!! Form::open(array('route' => ['update_mc_certificates','id'=> $id], 'name' => 'Form', 'id' => 'mc_certificates', 'method'=>'post', 'class'=>'form-horizontal form-validate-jquery')) !!}
        <fieldset class="content-group">
            <div class="form-group">
                <label class="col-lg-2 control-label label_required">Tipo certificado: </label>
                <div class="col-lg-5">
                    <select name="ad_retailer_product_id" class="form-control" id="ad_retailer_product_id" required="required">
                        <option value="">Seleccione</option>
                        @foreach($retailerProd as $retailerProduct)
                            @if($entity->ad_retailer_product_id == $retailerProduct->id)
                                <option value="{{ $retailerProduct->id }}" selected>{{ $retailerProduct->name_product }}</option>
                            @else
                                <option value="{{ $retailerProduct->id }}">{{ $retailerProduct->name_product }}</option>
                            @endif    
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
                            @if($entity->type == $type_campo['key'])
                                <option value="{{ $type_campo['key'] }}" selected>{{ $type_campo['value'] }}</option>
                            @else
                                <option value="{{ $type_campo['key'] }}">{{ $type_campo['value'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2 label_required">Nombre certificado</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-text-width"></i></span>
                        <input type="text"  value="{{ $entity->name }}" placeholder="Pregunta" class="form-control" name="name" id="name" required="required">
                    </div>
                </div>
            </div>
            <hr />
            <div class="form-group">
                <label class="radio-inline radio-right">
                    @if($entity->active == 1)
                        <input type="radio" value="1" checked="checked" name="active">
                    @else
                        <input type="radio" value="1" name="active">
                    @endif
                    Activar
                </label>

                <label class="radio-inline radio-right">
                    @if($entity->active == 0)
                        <input type="radio" value="0" checked="checked" name="active">
                    @else
                        <input type="radio" value="0" name="active">
                    @endif
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