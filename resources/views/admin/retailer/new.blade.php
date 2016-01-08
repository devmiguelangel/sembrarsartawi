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
            <h5 class="panel-title">Formulario nuevo Retailer</h5>
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

            <form class="form-horizontal" action="#">
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="txtRetailer" id="txtRetailer">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Dominio</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="txtDominio" id="txtDominio">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Archivo</label>
                        <div class="col-lg-10">
                            <input type="file" class="file-styled" name="txtFile" id="txtFile">
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-arrow-right14 position-right"></i>
                    </button>
                    <a href="{{route('admin.retailer.list', ['nav'=>'retailer', 'action'=>'list'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection