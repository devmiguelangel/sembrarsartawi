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
                Planes - Vida en Grupo
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.vi.planes.new', ['nav'=>'listplansvi', 'action'=>'new', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar Planes</span>
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
                    <th style="text-align: center;">Nombre</th>
                    <th style="text-align: center;">Descripcion</th>
                    <th style="text-align: center;">Prima Mensual (Bs.)</th>
                    <th style="text-align: center;">Prima Anual (Bs.)</th>
                    <th style="text-align: center;">Planes</th>
                    <th style="text-align: center;">Edad minima</th>
                    <th style="text-align: center;">Edad maxima</th>
                    <th class="text-center">Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($query as $data)
                    @var $plan = json_decode($data->plan, true);
                    <tr>
                        <td style="text-align: center;">
                            {{$data->name}}
                        </td>
                        <td style="text-align: left;">
                            {!! $data->description !!}
                        </td>
                        <td style="text-align: center;">
                            {{$data->monthly_premium}}
                        </td>
                        <td style="text-align: center;">
                            {{$data->annual_premium}}
                        </td>
                        <td style="text-align: left;">
                            - {{$plan[0]['cov'].' Hasta Bs. '.$plan[0]['rank']}}<br>
                            - {{$plan[1]['cov'].' Hasta Bs. '.$plan[1]['rank']}}<br>
                            - {{$plan[2]['cov'].' Hasta Bs. '.$plan[2]['rank']}}
                        </td>
                        <td style="text-align: center;">
                            {{$data->minimum_age}}
                        </td>
                        <td>
                            {{$data->maximum_age}}
                        </td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="{{route('admin.vi.planes.edit', ['nav'=>'listplansvi', 'action'=>'edit', 'id_retailer_product'=>$id_retailer_product, 'id_planes'=>$data->id])}}">
                                                <i class="icon-pencil3"></i> Editar
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