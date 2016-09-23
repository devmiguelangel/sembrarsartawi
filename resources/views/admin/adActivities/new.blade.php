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
        <h5 class="panel-title"><i class="icon-plus2"></i> Nueva Actividad</h5>
        <hr />
    </div>

    <div class="panel-body">

        {!! Form::open(array('route' => 'create_ad_activities', 'name' => 'Form', 'id' => 'ad_activities', 'method'=>'post', 'class'=>'form-horizontal form-validate-jquery')) !!}
        <fieldset class="content-group">
            <div class="form-group">
                <label class="control-label col-lg-2">Categor&iacute;a</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" placeholder="Categor&iacute;a" class="form-control" name="category" id="category">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2 label_required">Ocupación</label>
                <div class="col-lg-5">
                    <textarea placeholder="Ocupación" class="form-control" cols="5" rows="5" name="occupation" id="occupation" required="required"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2">C&oacute;digo</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" placeholder="C&oacute;digo" class="form-control" name="code" id="code">
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">
                Guardar <i class="icon-floppy-disk position-right"></i>
            </button>
            <a href="{{ route('adActivitiesList') }}" class="btn btn-danger">
                Cancelar <i class="icon-arrow-right14 position-right"></i>
            </a>
        </div>
        {!!Form::close()!!}
    </div>
</div>
@endsection