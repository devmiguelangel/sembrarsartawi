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
                Parametros Producto {{$query->producto}}
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
            @include('admin.partials.message')
        </div>

        <table class="table table-bordered table-striped table-hover dataTable no-footer">
            <thead>
            <tr>
                <th style="text-align: center;">Facturación</th>
                <th style="text-align: center;">Certificado Provisional</th>
                <th style="text-align: center;">Modalidad</th>
                <th style="text-align: center;">Garantía</th>
                <th style="text-align: center;">Facultativo</th>
                <th style="text-align: center;">Web Service</th>
                <th style="text-align: center;">Parametros Adicionales</th>
                <th style="text-align: center;">Estado</th>
                <th class="text-center">Acción</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td style="text-align: center;">
                    @if((boolean)$query->billing == true)
                        Si
                    @else
                        No
                    @endif
                </td>
                <td style="text-align: center;">
                    @if((boolean)$query->provisional_certificate == true)
                        Si
                    @else
                        No
                    @endif
                </td>
                <td style="text-align: center;">
                    @if((boolean)$query->modality == true)
                        Si
                    @else
                        No
                    @endif
                </td>
                <td style="text-align: center;">
                    @if((boolean)$query->warranty == true)
                        Si
                    @else
                        No
                    @endif
                </td>
                <td style="text-align: center;">
                    @if((boolean)$query->facultative == true)
                        Si
                    @else
                        No
                    @endif
                </td>
                <td style="text-align: center;">
                    @if((boolean)$query->ws == true)
                        Si
                    @else
                        No
                    @endif
                </td>
                <td style="text-align: center;">
                    <a href="{{route('admin.au.parameters.list-parameter-additional', ['nav'=>'au_parameter', 'action'=>'list_parameter_additional', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-success">Agregar/Modificar Parametros <i class="icon-plus2"></i></a>
                </td>
                <td>
                    @if((boolean)$query->active == true)
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
                                    <a href="{{route('admin.au.parameters.edit-parameter', ['nav'=>'au_parameter', 'action'=>'edit_parameter', 'id_retailer_product'=>$id_retailer_product])}}">
                                        <i class="icon-pencil3"></i> Editar
                                    </a>
                                </li>
                                <li>
                                    @if((boolean)$query->active == true)
                                        <a href="#"><i class="icon-cross"></i> Desactivar</a>
                                    @elseif((boolean)$query->active == false)
                                        <a href="#"><i class="icon-checkmark4"></i> Activar</a>
                                    @endif
                                </li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);
        });
    </script>
@endsection