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
            <h5 class="panel-title">Formulario editar Retailer</h5>
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
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'edit_retailer', 'name' => 'EditForm', 'id' => 'EditForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="txtRetailer" id="txtRetailer" value="{{$query->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Dominio</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="txtDominio" id="txtDominio" value="{{$query->domain}}" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Archivo</label>
                        <div class="col-lg-10">
                            <input type="file" class="file-styled" name="txtFile" id="txtFile">
                            <strong>Archivo actual:</strong> {{$query->image}}
                        </div>
                        <div>
                            @if($errors)
                                {{ $errors->first('txtFile')}}
                            @endif
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <input type="hidden" name="id_retailer", id="id_retailer" value="{{$query->id}}">
                    <input type="hidden" name="aux_file" id="aux_file" value="{{$query->image}}">
                    <a href="{{route('admin.retailer.list', ['nav'=>'retailer', 'action'=>'list'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
@endsection