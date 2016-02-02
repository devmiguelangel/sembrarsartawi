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
                Productos agregados a Compañias de Seguros
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.addproductcompany.new', ['nav'=>'addprocom', 'action'=>'new', 'id_company'=>$id_company])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar producto a compañía</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.addtoretailer.list', ['nav'=>'addtoretailer', 'action'=>'list', 'id_company'=>$id_company])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar a un Retailer</span>
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
                <th>Compañía de Seguros</th>
                <th>Producto</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($query as $data)
                <tr>
                <td>{{$data->company}}</td>
                <td>{{$data->product}}</td>
                <td>
                    @if((boolean)$data->active==true)
                        <span class="label label-success">Active</span>
                    @elseif((boolean)$data->active==false)
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
                                <li>
                                    @if((boolean)$data->active==true)
                                        <a href="#" id="{{$data->id_company_product}}|inactive|desactivar" class="confirm_active">
                                            <i class="icon-cross"></i> Desactivar
                                        </a>
                                    @elseif((boolean)$data->active==false)
                                        <a href="#" id="{{$data->id_company_product}}|active|activar" class="confirm_active">
                                            <i class="icon-checkmark4"></i> Activar
                                        </a>
                                    @endif
                                </li>
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
                var id_company_product = arr[0];
                var text = arr[1];
                bootbox.confirm("Esta seguro de "+arr[2]+" la pregunta ?.", function(result) {
                    if(result){
                        //bootbox.alert("Confirm result: " + result+ "/" +id_user);
                        $.get( "{{url('/')}}/admin/addproductcompany/active_ajax/"+id_company_product+"/"+text, function( data ) {
                            console.log(data);
                            if(data==1){
                                window.setTimeout('location.reload()', 1000);
                            }else if(data==0){
                                bootbox.alert("Error no se actualizo el dato.");
                            }
                        });
                    }
                });

            });
        });
    </script>
@endsection