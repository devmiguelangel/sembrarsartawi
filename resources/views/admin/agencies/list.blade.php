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
                        <a href="{{route('admin.agencies.new', ['nav'=>'agency', 'action'=>'new', 'id_retailer'=>auth()->user()->retailer->first()->id])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar agencia</span>
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
                <th>Agencia</th>
                <th class="text-center">Accion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($query as $data)
                <tr>
                    <td>{{$data->name}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('admin.agencies.edit', ['nav'=>'agency', 'action'=>'edit', 'id_agency'=>$data->id, 'id_retailer'=>$id_retailer])}}"><i class="icon-file-pdf"></i> Editar</a></li>
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