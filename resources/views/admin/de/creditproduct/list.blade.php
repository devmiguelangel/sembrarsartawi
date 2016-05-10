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
                Producto Crediticio - {{$retailer_product_query->companyProduct->product->name}}
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.de.creditproduct.new', ['nav'=>'credit_product', 'action'=>'new', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Nuevo registro</span>
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
                    <th>Producto Crediticio</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($query as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>
                            @if((boolean)$data->active == true)
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
                                        <li>
                                            @if((boolean)$data->active==true)
                                                <a href="#" id="{{$data->id}}|inactive|desactivar|{{$id_retailer_product}}" class="confirm_active">
                                                    <i class="icon-cross"></i> Desactivar
                                                </a>
                                            @else
                                                <a href="#" id="{{$data->id}}|active|activar|{{$id_retailer_product}}" class="confirm_active">
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
                <span class="text-semibold"></span> No existe productos crediticios registrados<br>
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
                var id_credit_product = arr[0];
                var text = arr[1];
                var id_retailer_product = arr[3];

                bootbox.confirm("Esta seguro de "+arr[2]+" el registro?", function(result) {
                    if(result){
                        //bootbox.alert("Confirm result: " + result+ "/" +id_user);
                        $.get( "{{url('/')}}/admin/de/creditproduct/active_ajax/"+id_credit_product+"/"+text+"/"+id_retailer_product, function( response ) {
                            //console.log(response);
                            if(response['response']=='ok'){
                                swal({
                                    title: response['message'],
                                    confirmButtonColor: "#2196F3"
                                });
                                window.setTimeout('location.reload()', 1000);
                            }else if(response['response']=='error'){
                                bootbox.alert("Error!! "+response['message']);
                            }
                        });
                    }
                });

            });
        });
    </script>
@endsection