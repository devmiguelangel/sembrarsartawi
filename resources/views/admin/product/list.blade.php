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
            <h5 class="panel-title">Lista de Registros</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.product.new', ['nav'=>'company', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar Producto</span>
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
                <th>Producto</th>
                <th>Tipo de Producto</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($query as $data)
                <tr>
                    <td>{{$data->name}}</td>
                    <td></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('admin.product.edit', ['nav'=>'product', 'action'=>'edit', 'id_product'=>$data->id])}}"><i class="icon-file-pdf"></i> Editar</a></li>
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