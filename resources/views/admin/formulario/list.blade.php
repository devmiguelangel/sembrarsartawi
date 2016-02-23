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
                Producto {{$query_prod->product}}
                <small class="display-block">Listado de formularios</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.formulario.new', ['nav'=>'form', 'action'=>'new', 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar formulario</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            @if (session('ok'))
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered" id="message-session">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold"></span> {{ session('ok')}}
                </div>
            @endif
        </div>
        @if(count($query_form)>0)
            <table class="table datatable-basic">
                <thead>
                <tr>
                    <th>Titulo Formulario</th>
                    <th>Producto</th>
                    <th>Archivo</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($query_form as $data)
                    <tr>
                        <td>{{$data->title}}</td>
                        <td>{{$query_prod->product}}</td>
                        <td><img src="{{asset('images/pdf.jpg')}}"></td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="{{route('admin.formulario.edit', ['nav'=>'form', 'action'=>'edit', 'id_forms'=>$data->id_forms, 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product])}}">
                                                <i class="icon-pencil3"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="confirm_delete" id="{{$data->id_forms}}">
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
                <span class="text-semibold"></span> No existe ningun formulario registrado
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);

            $('a[href].confirm_delete').click(function(e){

                var id_forms = $(this).prop('id');

                bootbox.confirm("Esta seguro de eliminar el registro ?", function(result) {
                    if(result){
                        $.get( "{{url('/')}}/admin/formulario/delete_ajax/"+id_forms, function( data ) {
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