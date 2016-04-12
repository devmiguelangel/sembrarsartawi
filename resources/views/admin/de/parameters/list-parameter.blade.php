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
                Parametros - Desgravamen
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <!--
                <ul class="icons-list">
                    <li>
                        <a href="company_new.html" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar Compañia</span>
                        </a>
                    </li>
                </ul>
                -->
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

        <table class="table datatable-basic">
            <thead>
            <tr>
                <th style="text-align: center;">Facturación</th>
                <th style="text-align: center;">Certificado Provisional</th>
                <th style="text-align: center;">Modalidad</th>
                <th style="text-align: center;">Facultativo</th>
                <th style="text-align: center;">Web Service</th>
                <th style="text-align: center;">Parametros Adicionales</th>
                <th style="text-align: center;">Estado</th>
                <th class="text-center">Acción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sql as $data)
                <tr>
                    <td style="text-align: center;">
                        @if((boolean)$data->billing == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->provisional_certificate == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->modality == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->facultative == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->ws == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <a href="{{route('admin.de.parameters.list-parameter-additional', ['nav'=>'de', 'action'=>'list_parameter_additional', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-success">Agregar/Modificar Parametros <i class="icon-plus2"></i></a>
                    </td>
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
                                        <a href="{{route('admin.de.parameters.edit-parameter', ['nav'=>'de', 'action'=>'edit_parameter', 'id_retailer_product'=>$id_retailer_product])}}">
                                            <i class="icon-pencil3"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        @if((boolean)$data->active == true)
                                            <a href="#"><i class="icon-cross"></i> Desactivar</a>
                                        @elseif((boolean)$data->active == false)
                                            <a href="#"><i class="icon-checkmark4"></i> Activar</a>
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
        $(document).ready(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);
        });
    </script>
@endsection