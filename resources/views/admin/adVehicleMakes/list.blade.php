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
            <h5 class="panel-title"> <i class="icon-list"></i> Marcas</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.vehicle_makes.new')}}" class="btn btn-link btn-float has-text">
                            <i class="icon-plus2"></i>
                            <span>Nueva Marca</span>
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
                        <th>Marca</th>
                        <th>Activo</th>
                        <th>Modelos</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entities as $entity)
                    <tr>
                        <td>{{ $entity->make }}</td>
                        <td>
                            @if($entity->active==1)
                                <i class="glyphicon glyphicon-ok"></i>
                            @else
                                <i class="glyphicon glyphicon-remove"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.vehicle_models.list', ['nav'=>'ad_vehicle_models', 'action'=>'list','id_make'=>$entity->id ]) }}" title="Agrear Modelos" class="btn btn-success">Agrear Modelos <i class="icon-plus2"></i></a>&nbsp;
                        </td>
                        <td class="text-center">
                            <a onclick="FormGralF.deleteElement('{{ route('admin.vehicle_makes.destroy', ['id'=>$entity->id ]) }}','')" title="Eliminar"><i class="icon-trash"></i></a>&nbsp;
                            <a href="{{ route('admin.vehicle_makes.edit', ['nav'=>'ad_vehicle_makes', 'action'=>'edit','id'=>$entity->id ]) }}" title="Editar"><i class="icon-pencil"></i></a>&nbsp;
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
@endsection