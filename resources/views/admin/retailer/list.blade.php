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
            <h5 class="panel-title">Listar Registros</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.retailer.new', ['nav'=>'retailer', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar Retailer</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

        </div>

        <table class="table datatable-basic">
            <thead>
            <tr>
                <th>Retailer</th>
                <th>Dominio</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @if(count($query)>0)
                @foreach($query as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->domain}}</td>
                        <td><img src="{{ asset('images/'.$data->image) }}" height="60"></td>
                        <td>
                            @if((boolean)$data->active==true)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-default">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="{{route('admin.retailer.edit', ['nav'=>'retailer', 'action'=>'edit', 'id_retailer'=>$data->id])}}">
                                                <i class="icon-file-pdf"></i> Editar
                                            </a>
                                        </li>
                                        <li><a href="#"><i class="icon-file-excel"></i> Desactivar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            @else
                <div class="alert alert-warning alert-styled-left">
                    <span class="text-semibold">Warning!</span> No existe ningun registro, ingrese un nuevo registro.
                </div>
            @endif
            </tbody>
        </table>
    </div>
@endsection