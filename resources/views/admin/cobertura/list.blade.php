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
                Coberturas agregados a un producto
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.cobertura.new', ['nav'=>'coverage', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar cobertura <br>a un producto</span>
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
                    <th>Cobertura</th>
                    <th>Numero Titulares</th>
                    <th>Retailer</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($query as $data)
                    <tr>
                    <td>{{$data->product}}</td>
                    <td>{{$data->coverage}}</td>
                    <td>{{$data->num_holder}}</td>
                    <td>{{$data->retailer}}</td>
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
                                    <li><a href="{{route('admin.cobertura.edit', ['nav'=>'coverage', 'action'=>'edit', 'id_retailer_product_coverage'=>$data->id_retailer_product_coverage])}}"><i class="icon-pencil3"></i> Editar</a></li>
                                    <li>
                                        @if((boolean)$data->active==true)
                                            <a href="#" id="{{$data->id_retailer_product_coverage}}|inactive|desactivar" class="confirm_active">
                                                <i class="icon-cross2"></i> Desactivar
                                            </a>
                                        @else
                                            <a href="#" id="{{$data->id_retailer_product_coverage}}|active|activar" class="confirm_active">
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
        @else
            <div class="alert alert-warning alert-styled-left">
                <span class="text-semibold"></span> No existe ninguna cobertura registrada:<br>
                - Verificar si se registro un nuevo Retailer<br>
                - Verificar el el retailer esta activado<br>
                - Verificar si el producto esta agregado a un retailer
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);

            $('a[href].confirm_active').click(function(e){

                var _id = $(this).prop('id');
                var arr = _id.split("|");
                var id_retailer_product_coverage = arr[0];
                var text = arr[1];
                bootbox.confirm("Esta seguro de "+arr[2]+" la cobertura ?", function(result) {
                    if(result){
                        //bootbox.alert("Confirm result: " + result+ "/" +id_user);
                        $.get( "{{url('/')}}/admin/cobertura/active_ajax/"+id_retailer_product_coverage+"/"+text, function( data ) {
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