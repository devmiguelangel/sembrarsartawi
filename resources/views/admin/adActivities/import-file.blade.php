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
    {!! Html::script('uploadfile/jquery.form.min.js') !!}
    {!! Html::script('uploadfile/script.js') !!}
    {!! Html::style('uploadfile/prograss_bar.css') !!}
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="form-wizard-title text-semibold" style="border-bottom: 0px;">
                <span class="form-wizard-count">
                    <i class="icon-file-upload"></i>
                </span>
                Formulario
                <small class="display-block">Importar archivo</small>
            </h5>
            <div class="heading-elements">

            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">
            {!! Form::open(array('route' => 'process_upload_form', 'name' => 'MyUploadForm', 'id' => 'MyUploadForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
                <div class="form-group">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <input type="file" class="file-input" multiple="multiple" data-show-upload="false" data-show-caption="true" name="FileInput" id="FileInput">
                        <img src="{{asset('images/ajax-loader.gif')}}" id="loading-img" style="display:none;" alt="Please Wait"/>
                        <div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div></div>
                        <div id="output"></div>
                        <span class="help-block">El formato del archivo a subir debe ser [xls]</span>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-6 text-right">
                    <button type="submit" class="btn bg-teal-400" id="submit-btn"><i class="icon-file-upload position-left"></i> Importar archivo</button>
                    <a href="{{route('adActivitiesList')}}" class="btn btn-primary">
                        Ir a la lista de ocupaciones <i class="icon-arrow-right14 position-right"></i>
                    </a>
                    <input type="hidden" id="admin" value="occupation">
                </div>
                <div class="col-lg-3"></div>

            {!!Form::close()!!}
        </div>
    </div>
@endsection