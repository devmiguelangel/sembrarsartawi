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
            <h5 class="panel-title">Registro de parametros</h5>
            <div class="heading-elements">
                <!--
                <ul class="icons-list">
                    <li>
                        <a href="company_new.html" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar Compañia</span>
                        </a>
                    </li>
                </ul>
                -->
            </div>
        </div>

        <div class="panel-body">

        </div>

        <table class="table datatable-basic">
            <thead>
            <tr>
                <th style="text-align: center;">Facturación</th>
                <th style="text-align: center;">Certificado Provisional</th>
                <th style="text-align: center;">Modalidad</th>
                <th style="text-align: center;">Facultativo</th>
                <th style="text-align: center;">Web Service</th>
                <th style="text-align: center;">Parametros Adicionales</th>
                <th style="text-align: center;">Estado</th>
                <th style="text-align: center;">Producto</th>
                <th class="text-center">Acción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sql as $data)
                <tr>
                    <td style="text-align: center;">
                        @if((boolean)$data->billing == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->provisional_certificate == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->modality == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->facultative == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->ws == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <a href="{{route('admin.de.parameters.list-parameter-additional', ['nav'=>'de', 'action'=>'list_parameter_additional', 'id_retailer_product'=>$id_retailer_product])}}">Agregar/Modificar Parametros</a>
                    </td>
                    <td>
                        @if((boolean)$data->active == true)
                            <span class="label label-success">Activo</span>
                        @else
                            <span class="label label-default">Inactivo</span>
                        @endif
                    </td>
                    <td>{{$data->producto}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{route('admin.de.parameters.edit-parameter', ['nav'=>'de', 'action'=>'edit_parameter', 'id_retailer_product'=>$id_retailer_product])}}">
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
            </tbody>
        </table>
    </div>
@endsection