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
            {!! Form::open(array('route' => 'upload_data_users', 'name' => 'MyUploadForm', 'id' => 'MyUploadForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}

                <div class="form-group">
                    <div class="col-lg-3"></div>
                    <label class="control-label col-lg-2">Retailer</label>
                    <div class="col-lg-4">
                        @if(count($retailer)>0)
                            <select name="id_retailer" id="id_retailer" class="form-control required">
                                <option value="0">Seleccione</option>
                                @foreach($retailer as $data_retailer)
                                    <option value="{{$data_retailer->id}}">{{$data_retailer->name}}</option>
                                @endforeach
                            </select>
                        @else
                            <div class="alert alert-warning alert-styled-left">
                                <span class="text-semibold"></span> No existe Retailer registrado.<br>
                            </div>
                        @endif
                        <div id="output_select_retailer"></div>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3"></div>
                    <label class="control-label col-lg-2">Region/Departamento</label>
                    <div class="col-lg-4">
                        <select class="form-control" id="id_retailer_city" name="id_retailer_city">
                            <option value="0">Seleccione</option>
                            @foreach($query_city as $data)
                                <option value="{{$data->id_retailer_city}}|{{$data->id_city}}">{{$data->city}}</option>
                            @endforeach
                        </select>
                        <div id="output_select"></div>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
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
                    <a href="{{route('admin.user.list', ['nav'=>'user', 'action'=>'list'])}}" class="btn btn-primary">
                        Ir a la lista de usuarios <i class="icon-arrow-right14 position-right"></i>
                    </a>
                    <input type="hidden" id="admin" value="user">
                </div>
                <div class="col-lg-3"></div>

            {!!Form::close()!!}
        </div>
    </div>
@endsection