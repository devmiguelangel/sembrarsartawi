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
            <h5 class="panel-title">&nbsp;</h5>
            <div class="heading-elements">

                <ul class="icons-list">
                    <li>
                        <a href="#" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar pregunta</span>
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
                <th>Nro</th>
                <th>Pregunta</th>
                <th>Respuesta esperada</th>
                <th style="text-align: center;">Estado</th>
                <th class="text-center">Accion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($query_list_q as $data)
                <tr>
                <td>{{$data->order}}</td>
                <td>{{$data->question}}</td>
                <td style="text-align: center;">
                    @if((boolean)$data->response==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
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
                                <li><a href="entidad_edit.html"><i class="icon-file-pdf"></i> Editar</a></li>
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