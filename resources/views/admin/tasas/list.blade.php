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
                Tasas agregadas a un producto
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.tasas.new', ['nav'=>'rate', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar tasa <br>a un producto</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @if(count($query)>0)
            <table class="table datatable-basic table-bordered">
                <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cobertura</th>
                    <th>Tasa Compañía</th>
                    <th>Tasa Banco</th>
                    <th>Tasa final</th>
                    <th>Retailer</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($query as $data)
                    <tr>
                    <td>{{$data->product}}</td>
                    <td>{{$data->coverage}}</td>
                    <td>{{$data->rate_company}}</td>
                    <td>{{$data->rate_bank}}</td>
                    <td>{{$data->rate_final}}</td>
                    <td>{{$data->retailer}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{route('admin.tasas.edit', ['nav'=>'rate', 'action'=>'list', 'id_rates'=>$data->id_rates])}}">
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
                <span class="text-semibold"></span> No existe ninguna tasa registrada
            </div>
        @endif
    </div>
@endsection