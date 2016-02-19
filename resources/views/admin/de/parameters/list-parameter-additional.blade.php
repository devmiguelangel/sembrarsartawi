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
                Parametros Adicionales - Desgravamen
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">

                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.de.parameters.new-parameter-additional', ['nav'=>'de', 'action'=>'new_parameter_additional', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar Parametros</span>
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
        @if(count($query)>0)
            <table class="table datatable-basic">
            <thead>
            <tr>
                <th style="text-align: center;">Nombre Parametro</th>
                <th style="text-align: center;">Edad Mínima</th>
                <th style="text-align: center;">Edad Máxima</th>
                <th style="text-align: center;">Monto Mínimo (USD)</th>
                <th style="text-align: center;">Monto Máximo (USD)</th>
                <th style="text-align: center;">Caducidad Cotización (días)</th>
                <th style="text-align: center;">Numero Titulares</th>
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
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{route('admin.de.parameters.edit-parameter-additional', ['nav'=>'de', 'action'=>'edit_parameter_additional', 'id_product_parameters'=>$data->id, 'id_retailer_product'=>$data->ad_retailer_product_id])}}">
                                            <i class="icon-pencil3"></i> Editar
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
                <span class="text-semibold"></span> No existe ningun registro, ingrese un nuevo registro.
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