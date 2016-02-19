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
    <!-- Basic datatable -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="form-wizard-title text-semibold" style="border-bottom: 0px;">
                <span class="form-wizard-count"><i class="icon-file-text2"></i></span>
                Tipo de cambio moneda
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.exchange.new', ['nav'=>'exchange', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar nuevo <br>tipo de cambio</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            @if(session('ok'))
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered" id="message-session">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold"></span> {{session('ok')}}
                </div>
            @endif
        </div>
        @if($exchange->count()>0)
            <table class="table datatable-basic">
                <thead>
                <tr>
                    <th>Valor USD.</th>
                    <th>Valor Bs.</th>
                    <th>Retailer</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($exchange as $data)
                    <tr>
                        <td>{{$data->usd_value}}</td>
                        <td>{{$data->bs_value}}</td>
                        <td>{{$data->entidad}}</td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('admin.exchange.edit', ['nav'=>'exchange', 'action'=>'edit', 'id_exchange'=>$data->id])}}"><i class="icon-pencil3"></i> Editar</a></li>
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
                <span class="text-semibold"></span> No existe ningun tipo de cambio registrado.
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
    <!-- /basic datatable -->
@endsection
