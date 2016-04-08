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
            <h5 class="panel-title"> <i class="icon-list"></i> Tipos de Vehículos</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.vehicle.new')}}" class="btn btn-link btn-float has-text">
                            <i class="icon-plus2"></i>
                            <span>Nuevo tipo <br>de vehiculo</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr />
        <div class="panel-body ">
            @include('admin.partials.message')
            <table class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer">
                <thead>
                    <tr>
                        <th>Tipo de Vehículo</th>
                        <th>Porcentaje</th>
                        <th>Categoría</th>
                        <th>Activo</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entities as $entity)
                    <tr>
                        <td>{{ $entity->vehicle }}</td>
                        <td>{{ $entity->percentage }}</td>
                        <td>
                            @if($entity->ad_retailer_product_category_id)
                                {{ $entity->category->category_name }}
                            @else
                                Ninguno
                            @endif
                        </td>
                        <td>
                            @if($entity->active==1)
                                <i class="glyphicon glyphicon-ok"></i>
                            @else
                                <i class="glyphicon glyphicon-remove"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            <a onclick="FormGralF.deleteElement('{{ route('admin.vehicle.destroy', ['id'=>$entity->id ]) }}','')" title="Eliminar"><i class="icon-trash"></i></a>&nbsp;
                            <a href="{{ route('admin.vehicle.edit', ['nav'=>'ad_vehicle_types', 'action'=>'edit','id'=>$entity->id ]) }}" title="Editar"><i class="icon-pencil"></i></a>&nbsp;
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
@endsection