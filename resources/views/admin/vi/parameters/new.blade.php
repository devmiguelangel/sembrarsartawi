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
            <div class="heading-elements">
                <!--
                <ul class="icons-list">

                    <li><a data-action="reload"></a></li>

                </ul>
                -->
            </div>
        </div>

        <div class="panel-body">
            {!! Form::open(array('route' => 'new_parameter', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Facturación</label>
                    <label class="radio-inline">
                        <input type="radio" name="fact" class="styled" value="1">SI
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="fact" class="styled" value="0">NO
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Certificado Provisional</label>
                    <label class="radio-inline">
                        <input type="radio" name="cert" class="styled" value="1">SI
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="cert" class="styled" value="0">NO
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Modalidad</label>
                    <label class="radio-inline">
                        <input type="radio" name="moda" class="styled" value="1">SI
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="moda" class="styled" value="0">NO
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Facultativo</label>
                    <label class="radio-inline">
                        <input type="radio" name="facu" class="styled" value="1">SI
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="facu" class="styled" value="0">NO
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Web Service</label>
                    <label class="radio-inline">
                        <input type="radio" name="webs" class="styled" value="1">SI
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="webs" class="styled" value="0">NO
                    </label>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{ route('admin.de.parameters.list-parameter', ['nav'=>'vi', 'action'=>'list', 'id_retailer_product'=>$id_retailer_product]) }}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
@endsection