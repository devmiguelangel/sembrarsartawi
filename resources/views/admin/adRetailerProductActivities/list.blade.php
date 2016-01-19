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
            <h5 class="panel-title"> <i class="icon-list"></i> Asignacion de Actividades</h5>
            <div class="heading-elements">
                
                <ul class="icons-list">      
                    <li>
                        <a href="{{route('retailerProductActivitiesFormNew')}}" class="btn btn-link btn-float has-text">
                            <i class="icon-plus2"></i>
                            <span>Nuevo Asignaci&oacute;n</span>
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
                        <th>Producto</th>
                        <th>Actividades</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entities as $productActivities)
                    <tr>
                        <td><!--{{ $productActivities->ad_retailer_product_id }}-->
                            <a href="{{ route('retailerProductActivitiesFormEdit', ['id'=>$productActivities->ad_retailer_product_id ]) }}" title="Editar">
                                {{ $productActivities->name }}
                            </a>
                        </td>
                        <td>
                            @if(isset($selection[$productActivities->ad_retailer_product_id]) and count($selection[$productActivities->ad_retailer_product_id]) > 0)
                            <div class="col-lg-1">
                                <strong>{{ count($selection[$productActivities->ad_retailer_product_id]) }}</strong>
                            </div>
                            <div class="col-lg-11">
                                <ul class="icons-list">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @foreach($selection[$productActivities->ad_retailer_product_id] as $activity)
                                            <li><a href="#">{{ $activity }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                            </div>
                            @else
                            No existen Actividades
                            @endif
                        </td>
                        <td class="text-center">
                            <a onclick="FormGralF.deleteElement('{{ route('retailerProductActivitiesFormDestroy', ['id'=>$productActivities->ad_retailer_product_id ]) }}','')" title="Eliminar"><i class="icon-trash"></i></a>&nbsp;
                            <a href="{{ route('retailerProductActivitiesFormEdit', ['id'=>$productActivities->ad_retailer_product_id ]) }}" title="Editar"><i class="icon-pencil"></i></a>&nbsp;
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
            <div class="text-right">
                <a href="{{route('adActivitiesList')}}" class="btn btn-primary">
                    Administrar Actividades <i class="icon-arrow-right14"></i>
                </a>    
            </div>
        </div>
    </div>
@endsection