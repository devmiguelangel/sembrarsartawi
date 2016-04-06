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
                Tabla de Datos {{$query_retailer->product}}
                <small class="display-block">Contenido</small>
            </h5>
            <div class="heading-elements">
                @if(count($query)==0)
                    <ul class="icons-list">
                        <li>
                            <a href="{{route('admin.au.content.new', ['nav'=>'au_content', 'action'=>'new', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-link btn-float has-text">
                                <i class="icon-file-plus text-primary"></i>
                                <span>Crear Contenido</span>
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
        <div class="panel-body">
            @include('admin.partials.message')
        </div>
        @if(count($query)>0)
            @var $contenido = substr_replace($query->content, '...', 500)

            <table class="table table-bordered table-striped table-hover dataTable no-footer">
                <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Contenido</th>
                    <th>Imagen</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$query->title}}</td>
                    <td style="text-align: left;">{!! $contenido !!}</td>
                    <td><img src="{{ asset($query->file) }}" height="60"></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{route('admin.au.content.edit', ['nav'=>'au_content', 'action'=>'edit', 'id_retailer_product'=>$id_retailer_product, 'id_content'=>$query->id])}}">
                                            <i class="icon-pencil3"></i> Editar
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        @else
            <div class="alert alert-warning alert-styled-left">
                <span class="text-semibold"></span> No existe ningun contenido registrado.
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);
        });
    </script>
@endsection