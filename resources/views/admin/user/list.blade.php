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
                Usuarios
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.user.new', ['nav'=>$nav, 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Crear nuevo usuario</span>
                        </a>
                    </li>
                    @if(auth()->user()->type->code=='ADT')
                        <li>
                            <a href="{{route('admin.user.import-file', ['nav'=>$nav, 'action'=>'import'])}}" class="btn btn-link btn-float has-text">
                                <i class="icon-file-download2"></i>
                                <span>Importar archivo</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="panel-body">
            @if(session('ok'))
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered" id="message-session">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold">Ok!</span> {{session('ok')}}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-styled-left alert-bordered">
                    <span class="text-semibold">Error!</span> {{ session('error') }}
                </div>
            @endif
        </div>
        @if(count($users)>0)
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
                                    <a href="{{ route('admin.user.edit', ['nav'=>'user', 'action'=>'edit', 'id_user'=>$data->id_user, 'id_retailer'=>$data->ad_retailer_id]) }}">
                                        <i class="icon-pencil3"></i> Editar
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.user.change-password', ['nav'=>'user', 'action'=>'changepass', 'id_user'=>$data->id_user, 'id_retailer'=>$data->ad_retailer_id]) }}">
                                        <i class="icon-key"></i> Cambiar contraseña
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.user.reset-password', ['nav'=>'user', 'action'=>'resetpass', 'id_user'=>$data->id_user, 'id_retailer'=>$data->ad_retailer_id]) }}">
                                        <i class="icon-spinner11"></i> Resetear contraseña
                                    </a>
                                </li>
                                <li>
                                    @if((boolean)$data->active==true)
                                        <a href="{{route('active_inactive_user', ['id_user'=>$data->id_user, 'text'=>'inactive'])}}" class="confirm_active_user" id="baja|{{$data->full_name}}">
                                            <i class="icon-user-cancel"></i>Dar baja
                                        </a>
                                    @elseif((boolean)$data->active==false)
                                        <a href="{{route('active_inactive_user', ['id_user'=>$data->id_user, 'text'=>'active'])}}" class="confirm_active_user" id="alta|{{$data->full_name}}">
                                            <i class="icon-user-cancel"></i>Dar alta
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
                <span class="text-semibold"></span> No existe ninguna usuario registrado.
            </div>
        @endif
    </div>
    <script type="text/javascript">
        // Confirmation dialog
        $(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);
        });
    </script>
@endsection