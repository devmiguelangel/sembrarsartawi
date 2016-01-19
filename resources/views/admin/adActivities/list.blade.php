@extends('admin.layout')

@section('menu-user')
    @include('admin.partials.menu-user')
@endsection

@section('menu-main')
    @include('admin.partials.menu-main')
@endsection

@section('header')
    @include('admin.partials.header')
    @include('admin.partials.message')
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> <i class="icon-list"></i> Lista de Actividades</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('adActivitiesFormNew')}}" class="btn btn-link btn-float has-text">
                            <i class="icon-plus2"></i>
                            <span>Nueva Actividad</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr />
        <div class="panel-body ">
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Ocupación</th>
                        <th>Código</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entities as $adActivities)
                    <tr>
                        <td>{{ $adActivities->category }}</td>
                        <td>{{ $adActivities->occupation }}</td>
                        <td>{{ $adActivities->code }}</td>
                        <td class="text-center">
                            <a onclick="FormGralF.deleteElement('{{ route('adActivitiesFormDestroy', ['id'=>$adActivities->id ]) }}','')" title="Eliminar"><i class="icon-trash"></i></a>&nbsp;
                            <a href="{{ route('adActivitiesFormEdit', ['id'=>$adActivities->id ]) }}" title="Editar"><i class="icon-pencil"></i></a>&nbsp;
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
            <div class="text-right">
                <a href="{{route('adRetailerProductActivities')}}" class="btn btn-primary">
                    Administrar Ocupaci&oacute;n <i class="icon-arrow-right14"></i>
                </a>
            </div>
        </div>
    </div>
@endsection