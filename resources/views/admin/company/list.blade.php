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
            <h5 class="panel-title">Lista de Registros</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.company.new', ['nav'=>'company', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar Compañia</span>
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
                <th>Compañia de Seguros</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($company_new as $data)
                <tr>
                <td>{{$data->name}}</td>
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
                                <li><a href="{{route('admin.company.edit', ['nav'=>'company', 'action'=>'edit', 'id_company'=>$data->id])}}"><i class="icon-file-pdf"></i> Editar</a></li>
                                <li><a href="#"><i class="icon-file-excel"></i> Desactivar</a></li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection