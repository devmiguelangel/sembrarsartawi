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
                Parametros Adicionales - Producto Automotores
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">

                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.au.parameters.new-parameter-additional', ['nav'=>'au_parameter', 'action'=>'new_parameter_additional', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar Parametros</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <div class="panel-body">
            @include('admin.partials.message')
        </div>
        @if(count($query)>0)
            <table class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer">
                <thead>
                <tr>
                    <th style="text-align: center;">Nombre Parametro</th>
                    <th style="text-align: center;">Edad Mínima</th>
                    <th style="text-align: center;">Edad Máxima</th>
                    <th style="text-align: center;">Monto Mínimo (USD)</th>
                    <th style="text-align: center;">Monto Máximo (USD)</th>
                    <th style="text-align: center;">Caducidad Cotización (días)</th>
                    <th style="text-align: center;">Cantidad de Autos</th>
                    <th style="text-align: center;">Antigüedad de Autos</th>
                    <th class="text-center">Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($query as $data)
                    <tr>
                        <td style="text-align:center;">{{$data->name}}</td>
                        <td style="text-align:center;">{{$data->age_min}}</td>
                        <td style="text-align:center;">{{$data->age_max}}</td>
                        <td style="text-align:center;">{{$data->amount_min}}</td>
                        <td style="text-align:center;">{{$data->amount_max}}</td>
                        <td style="text-align:center;">{{$data->expiration}}</td>
                        <td style="text-align:center;">{{$data->detail}}</td>
                        <td style="text-align:center;">{{$data->old_car}}</td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="{{route('admin.au.parameters.edit-parameter-additional', ['nav'=>'au_parameter', 'action'=>'edit_parameter_additional', 'id_product_parameters'=>$data->id, 'id_retailer_product'=>$data->ad_retailer_product_id])}}">
                                                <i class="icon-pencil3"></i>Editar
                                            </a>
                                        </li>
                                        @if($data->slug!='GE')
                                            <li>
                                                <a href="#" class="confirm_delete" id="{{$data->id}}|{{$data->ad_retailer_product_id}}">
                                                    <i class="icon-trash"></i> Eliminar
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
        @else
            <div class="alert alert-warning alert-styled-left">
                <span class="text-semibold"></span> No existe ningun registro, ingrese un nuevo registro.
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);

            $('a[href].confirm_delete').click(function(e){
                var _id = $(this).prop('id');
                var vec = _id.split('|');
                var id_product_parameters = vec[0];
                var ad_retailer_product_id = vec[1];

                bootbox.confirm("Esta seguro de eliminar el registro ?", function(result) {
                    if(result){
                        $.get( "{{url('/')}}/admin/au/parameters/delete_ajax/"+id_product_parameters+"/"+ad_retailer_product_id, function( data ) {
                            console.log(data);
                            var arr = data.split('|');
                            if(arr[0]==1){
                                swal({
                                    title: arr[1],
                                    confirmButtonColor: "#2196F3"
                                });
                                window.setTimeout('location.reload()', 2000);
                            }else if(arr[0]==0){
                                swal({
                                    title: "Error!! "+arr[1],
                                    confirmButtonColor: "#2196F3"
                                });
                            }
                        });
                    }
                });

            });
        });
    </script>
@endsection