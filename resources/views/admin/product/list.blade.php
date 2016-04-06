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
                Productos
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.product.new', ['nav'=>'product', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar nuevo Producto</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            @include('admin.partials.message')
        </div>
        @if(count($query)>0)
            <table class="table table-bordered table-striped table-hover dataTable no-footer">
            <thead>
            <tr>
                <th>Producto</th>
                <th>Codigo</th>
                <th>Tipo de Producto</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($query as $data)
                <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->code}}</td>
                    <td>{{$parameter[$data->type]}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('admin.product.edit', ['nav'=>'product', 'action'=>'edit', 'id_product'=>$data->id])}}"><i class="icon-pencil3"></i> Editar</a></li>
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
                <span class="text-semibold"></span> No existe ningun producto registrado.
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function() {
                $('#message-session').fadeOut('slow');
            }, 3000);
        });
    </script>
@endsection