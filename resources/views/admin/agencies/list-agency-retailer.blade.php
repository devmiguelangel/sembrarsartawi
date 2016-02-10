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
                Agencias  agregadas a departamento
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <a href="{{route('admin.agencies.new-agency-retailer', ['nav'=>$nav, 'action'=>'new_agency_retailer'])}}" class="btn btn-link btn-float has-text">
                    <i class="icon-file-plus text-primary"></i>
                    <span>Agregar Agencias <br>a Departamento</span>
                </a>
            </div>
        </div>

        <div class="panel-body">

        </div>
        @if(count($query)>0)
            <table class="table datatable-basic table-bordered">
                <thead>
                <tr>
                    <th>Agencia</th>
                    <th>Departamento</th>
                    <th>Retailer</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($query as $data)
                    <tr>
                        <td>{{$data->agency}}</td>
                        <td>{{$data->city}}</td>
                        <td>{{$data->retailer}}</td>
                        <td>
                            @if((boolean)$data->active==true)
                                <span class="label label-success">Active</span>
                            @else
                                <span class="label label-default">Inactive</span>
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
                                            @if((boolean)$data->active==true)
                                                <a href="#"><i class="icon-cross"></i> Desactivar</a>
                                            @else
                                                <a href="#"><i class="icon-file-pdf"></i> Activar</a>
                                            @endif
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
            <a href="{{route('admin.agencies.list', ['nav'=>'agency', 'action'=>'list'])}}" class="btn btn-primary">
                Administrar Agencias  <i class="icon-arrow-right7 position-right"></i>
            </a>
        </div>
    </div>
@endsection