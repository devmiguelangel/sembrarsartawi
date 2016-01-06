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
            <h5 class="panel-title">Lista Parametros Adicionales</h5>
            <div class="heading-elements">

                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.de.parameters.new-parameter-additional', ['nav'=>'de', 'action'=>'new_parameter_additional', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar Parametros</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <div class="panel-body">

        </div>
        @if(count($query)>0)
            <table class="table datatable-basic">
            <thead>
            <tr>
                <th style="text-align: center;">Nombre Parametro</th>
                <th style="text-align: center;">Edad Mínima</th>
                <th style="text-align: center;">Edad Máxima</th>
                <th style="text-align: center;">Monto Mínimo (USD)</th>
                <th style="text-align: center;">Monto Máximo (USD)</th>
                <th style="text-align: center;">Caducidad Cotización (días)</th>
                <th style="text-align: center;">Numero Titulares</th>
                <th class="text-center">Acción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($query as $data)
                <tr>
                    <td style="text-align:center;">{{$data->name}}</td>
                    <td style="text-align:center;">{{$data->age_min}}</td>
                    <td style="text-align:center;">{{$data->age_max}}</td>
                    <td style="text-align:center;">{{$data->amount_min}}</td>
                    <td style="text-align:center;">{{$data->amount_max}}</td>
                    <td style="text-align:center;">{{$data->expiration}}</td>
                    <td style="text-align:center;">{{$data->detail}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{route('admin.de.parameters.edit-parameter-additional', ['nav'=>'de', 'action'=>'edit_parameter_additional', 'id_product_parameters'=>$data->id, 'id_retailer_product'=>$data->ad_retailer_product_id])}}">
                                            <i class="icon-file-pdf"></i> Editar
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
    </div>
@endsection