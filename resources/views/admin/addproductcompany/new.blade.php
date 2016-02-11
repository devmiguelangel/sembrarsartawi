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
            <h5 class="panel-title">Formulario agregar producto</h5>
            <div class="heading-elements">
                <!--
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
                -->
            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'new_addproduct', 'name' => 'NewForm', 'id' => 'NewForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Compañía</label>
                        <div class="col-lg-10">
                            {{$query_cia->name}}
                            <input type="hidden" name="id_company" id="id_company" value="{{$id_company}}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Productos</label>
                        <div class="col-lg-10">
                            @if(count($query_prod)>0)
                                <select name="id_product" id="id_product" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($query_prod as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-info alert-styled-left alert-bordered">
                                    <span class="text-semibold">Alert</span> No existe ningun producto, ingrese un nuevo producto.
                                </div>
                            @endif
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    @if(count($query_prod)>0)
                        <button type="submit" class="btn btn-primary">
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary" disabled>
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @endif
                    <a href="{{route('admin.addproductcompany.list', ['nav'=>'company', 'action'=>'list', 'id_company'=>$id_company])}}" class="btn btn-primary">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
@endsection