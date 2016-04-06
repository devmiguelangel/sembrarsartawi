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
                Forma de pagos producto {{$retailer_product_query->companyProduct->product->name}}
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.payment.new', ['nav'=>'payment', 'action'=>'new', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar forma de pago</span>
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
                    <th>Forma de Pago</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($query as $data)
                    @var $parameter = config('base.payment_methods');
                    @var $name = $parameter[$data->payment_method];
                    <tr>
                        <td>{{$data->product}}</td>
                        <td>{{$name}}</td>
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
                                        <li>
                                            @if((boolean)$data->active==true)
                                                <a href="#" id="{{$data->id_payment_method}}|inactive|desactivar|{{$id_retailer_product}}" class="confirm_active">
                                                    <i class="icon-cross2"></i> Desactivar
                                                </a>
                                            @else
                                                <a href="#" id="{{$data->id_payment_method}}|active|activar|{{$id_retailer_product}}" class="confirm_active">
                                                    <i class="icon-checkmark4"></i> Activar
                                                </a>
                                            @endif
                                        </li>
                                        <li>
                                            <a href="#" class="confirm_delete" id="{{$data->id_payment_method}}|{{$id_retailer_product}}">
                                                <i class="icon-trash"></i> Eliminar
                                            </a>
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
                <span class="text-semibold"></span> No existe ningun dato registrado
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);

            $('a[href].confirm_delete').click(function(e){

                var _id = $(this).prop('id');
                var vec = _id.split('|');
                var id_payment_method = vec[0];
                var id_retailer_product = vec[1];
                //var id_rates = $(this).prop('id');

                bootbox.confirm("Esta seguro de eliminar el registro ?", function(result) {
                    if(result){
                        $.get( "{{url('/')}}/admin/payment/delete_ajax/"+id_payment_method+"/"+id_retailer_product, function( data ) {
                            console.log(data);

                            if(data['response']=='ok'){
                                swal({
                                    title: data['detail'],
                                    confirmButtonColor: "#2196F3"
                                });
                                window.setTimeout('location.reload()', 2000);
                            }else if(data['response']=='error'){
                                swal({
                                    title: "Error!! "+data['detail'],
                                    confirmButtonColor: "#2196F3"
                                });
                            }
                        });
                    }
                });

            });

            $('a[href].confirm_active').click(function(e){

                var _id = $(this).prop('id');
                var arr = _id.split("|");
                var id_payment_method = arr[0];
                var text = arr[1];
                var id_retailer_product = arr[3];
                bootbox.confirm("Esta seguro de "+arr[2]+" el registro?", function(result) {
                    if(result){
                        //bootbox.alert("Confirm result: " + result+ "/" +id_user);
                        $.get( "{{url('/')}}/admin/payment/active_ajax/"+id_payment_method+"/"+text+"/"+id_retailer_product, function( data ) {
                            console.log(data);
                            if(data['response']=='ok'){
                                window.setTimeout('location.reload()', 1000);
                            }else if(data['response']=='error'){
                                bootbox.alert("Error!! "+data['text']);
                            }
                        });
                    }
                });

            });
        });
    </script>
@endsection