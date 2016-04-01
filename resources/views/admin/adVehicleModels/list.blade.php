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
            <h5 class="panel-title"> <i class="icon-list"></i> Modelos - {{ $make->make }}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.vehicle_models.new',[ 'id_make'=>$make ])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-plus2"></i>
                            <span>Nuevo Modelo</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr />
        <div class="panel-body ">
            @include('admin.partials.message')
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>Modelo</th>
                        <th>Activo</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entities as $entity)
                    <tr>
                        <td>{{ $entity->model }}</td>
                        <td>
                            @if($entity->active==1)
                                <i class="glyphicon glyphicon-ok"></i>
                            @else
                                <i class="glyphicon glyphicon-remove"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            <a onclick="FormGralF.deleteElement('{{ route('admin.vehicle_models.destroy', ['id'=>$entity->id, 'id_make'=>$make->id ]) }}','')" title="Eliminar"><i class="icon-trash"></i></a>&nbsp;
                            <a href="{{ route('admin.vehicle_models.edit', ['nav'=>'ad_vehicle_models', 'action'=>'edit','id'=>$entity->id ]) }}" title="Editar"><i class="icon-pencil"></i></a>&nbsp;
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
            <div class="text-right">
                <a href="{{route('admin.vehicle_makes.list', ['nav'=>'ad_vehicle_makes', 'action'=>'list'])}}" class="btn btn-primary">
                    Administrar Marcas <i class="icon-arrow-right14"></i>
                </a>
            </div>
        </div>
    </div>
@endsection