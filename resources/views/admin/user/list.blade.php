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
            <h5 class="panel-title">Tabla Usuarios</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.user.new', ['nav'=>$nav, 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Nuevo usuario</span>
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
                <th>Tipo usuario</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Correo electronico</th>
                <th>Departamento Regional</th>
                <th>Agencia</th>
                <th>Estado</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $data)
                <tr>
                <td>{{$data->type}}</td>
                <td>{{$data->username}}</td>
                <td>{{$data->full_name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->cities}}</td>
                <td>{{$data->agencies}}</td>
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
                                    <a href="{{ route('admin.user.edit', ['nav'=>'user', 'action'=>'edit', 'id_user'=>$data->id_user]) }}">
                                        <i class="icon-file-pdf"></i> Editar
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.user.change-password', ['nav'=>'user', 'action'=>'changepass', 'id_user'=>$data->id_user]) }}">
                                        <i class="icon-file-excel"></i> Cambiar contraseña
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.user.reset-password', ['nav'=>'user', 'action'=>'resetpass', 'id_user'=>$data->id_user]) }}">
                                        <i class="icon-file-word"></i> Resetear contraseña
                                    </a>
                                </li>
                                <li>
                                    @if((boolean)$data->active==true)
                                        <a href="#" class="confirm_active" id="{{$data->id_user}}|inactive|baja|{{$data->full_name}}">
                                            <i class="icon-file-empty"></i>Dar baja
                                        </a>
                                    @elseif((boolean)$data->active==false)
                                        <a href="#" class="confirm_active" id="{{$data->id_user}}|active|alta|{{$data->full_name}}">
                                            <i class="icon-file-empty"></i>Dar alta
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
        // Confirmation dialog
        $(document).ready(function(){
            //$('.confirm_active').on('click', function() {
            $('a[href].confirm_active').click(function(e){

                var _id = $(this).prop('id');
                var arr = _id.split("|");
                var id_user = arr[0];
                var text = arr[1];
                bootbox.confirm("Esta seguro de dar "+arr[2]+" al usuario "+arr[3]+"?.", function(result) {
                    if(result){
                        //bootbox.alert("Confirm result: " + result+ "/" +id_user);
                        $.get( "{{url('/')}}/admin/user/active_ajax/"+id_user+"/"+text, function( data ) {
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