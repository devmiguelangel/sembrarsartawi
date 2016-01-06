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
    <!-- Basic datatable -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Lista Tipo de Cambio</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.exchange.new', ['nav'=>'exchange', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar registro</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

        </div>
        @if($exchange->count()>0)
            <table class="table datatable-basic">
                <thead>
                <tr>
                    <th>Valor USD.</th>
                    <th>Valor Bs.</th>
                    <th>Fecha de registro</th>
                    <th>vigente</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($exchange as $data)
                    <tr>
                        <td>{{$data->usd_value}}</td>
                        <td>{{$data->bs_value}}</td>
                        <td>{{$data->creation_date}}</td>
                        <td><span class="label label-success">Active{{$data->id}}</span></td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('admin.exchange.edit', ['nav'=>'exchange', 'action'=>'edit', 'id_exchange'=>$data->id])}}"><i class="icon-file-pdf"></i> Editar</a></li>
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
    <!-- /basic datatable -->
@endsection