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
                Retailers
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                @if(count($query)==0)
                    <ul class="icons-list">
                        <li>
                            <a href="{{route('admin.retailer.new', ['nav'=>'retailer', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                                <i class="icon-file-plus text-primary"></i>
                                <span>Agregar Retailer</span>
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>

        <div class="panel-body">

        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Retailer</th>
                <th>Dominio</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @if(count($query)>0)
                @foreach($query as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->domain}}</td>
                        <td><img src="{{ asset($data->image) }}" height="60"></td>
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
                                            <a href="{{route('admin.retailer.edit', ['nav'=>'retailer', 'action'=>'edit', 'id_retailer'=>$data->id])}}">
                                                <i class="icon-pencil3"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            @if((boolean)$data->active==true)
                                                <a href="#" id="{{$data->id}}|inactive|desactivar" class="confirm_active">
                                                    <i class="icon-cross"></i> Desactivar
                                                </a>
                                            @else
                                                <a href="#" id="{{$data->id}}|active|activar" class="confirm_active">
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
            @else
                <div class="alert alert-warning alert-styled-left">
                    <span class="text-semibold">Warning!</span> No existe ningun registro, ingrese un nuevo registro.
                </div>
            @endif
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('a[href].confirm_active').click(function(e){

                var _id = $(this).prop('id');
                var arr = _id.split("|");
                var id_retailer = arr[0];
                var text = arr[1];
                bootbox.confirm("Esta seguro de "+arr[2]+" la pregunta ?.", function(result) {
                    if(result){
                        //bootbox.alert("Confirm result: " + result+ "/" +id_user);
                        $.get( "{{url('/')}}/admin/retailer/active_ajax/"+id_retailer+"/"+text, function( data ) {
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