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
                <span class="form-wizard-count"><i class="icon-file-text2"></i></span>
                Agencias
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.agencies.new', ['nav'=>'agency', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Crear agencia</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

        </div>
        @if(count($query)>0)
            <table class="table datatable-basic table-bordered">
            <thead>
            <tr>
                <th style="text-align: left;">Agencias</th>
                <th class="text-center">Accion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($query as $data)
                <tr>
                    <td style="text-align: left">{{$data->name}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{route('admin.agencies.edit', ['nav'=>'agency', 'action'=>'edit', 'id_agency'=>$data->id])}}">
                                            <i class="icon-pencil3"></i>Editar
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <div class="alert alert-warning alert-styled-left">
                <span class="text-semibold">Warning!</span> No existe ningun registro, ingrese un nuevo registro.
            </div>
        @endif
        <div class="panel-heading" style="text-align: right;">
            <a href="{{route('admin.agencies.list-agency-retailer', ['nav'=>'agency', 'action'=>'list_agency_retailer'])}}" class="btn btn-primary">
                Administrar agencias/departamento  <i class="icon-arrow-right7 position-right"></i>
            </a>
        </div>
    </div>
@endsection