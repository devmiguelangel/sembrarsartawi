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
                Productos Compañías agregados a Retailer
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.addtoretailer.new', ['nav'=>'addtoretailer', 'action'=>'new', 'id_company'=>$id_company])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar producto a Retailer</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Retailer</th>
                <th>Producto</th>
                <th>Tipo Producto</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($query as $data)
                <tr>
                <td>{{$data->retailer}}</td>
                <td>{{$data->product}}</td>
                <td>{{$parameter[$data->type]}}</td>
                <td>
                    @if((boolean)$data->active==true)
                        <span class="label label-success">Activo</span>
                    @else
                        <span class="label label-default">Inactivo</span>
                    @endif
                </td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                @if((boolean)$data->active==true)
                                    <li>
                                        <a href="#" id="{{$data->id_retailer_products}}|inactive|desactivar" class="confirm_active">
                                            <i class="icon-cross2"></i> Desactivar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.policy.list', ['nav'=>'policynumber', 'action'=>'list', 'id_retailer_products'=>$data->id_retailer_products, 'id_company'=>$id_company, 'code_product'=>$data->code])}}">
                                            <i class="icon-pencil7"></i> Administrar numero póliza
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="#" id="{{$data->id_retailer_products}}|active|activar" class="confirm_active">
                                            <i class="icon-checkmark4"></i> Activar
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('a[href].confirm_active').click(function(e){

                var _id = $(this).prop('id');
                var arr = _id.split("|");
                var id_retailer_products = arr[0];
                var text = arr[1];
                bootbox.confirm("Esta seguro de "+arr[2]+" la pregunta ?.", function(result) {
                    if(result){
                        //bootbox.alert("Confirm result: " + result+ "/" +id_user);
                        $.get( "{{url('/')}}/admin/addtoretailer/active_ajax/"+id_retailer_products+"/"+text, function( data ) {
                            console.log(data);
                            if(data==1){
                                window.setTimeout('location.reload()', 1000);
                            }else if(data==0){
                                bootbox.alert("Error!! no se actualizo el dato, vuelva a intentarlo otra vez");
                            }
                        });
                    }
                });

            });
        });
    </script>
@endsection