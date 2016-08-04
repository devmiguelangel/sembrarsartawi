@extends('admin.layout')

@section('menu-user')
    @include('admin.partials.menu-user')
@endsection

@section('menu-main')
    @include('admin.partials.menu-main')
@endsection

@section('header')
    @include('admin.partials.header')
    @include('admin.partials.message')
@endsection


@section('content')

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> <i class="icon-list"></i> Asignacion de Actividades</h5>
            <div class="heading-elements">
                
                <ul class="icons-list">      
                    <li>
                        <a href="{{route('retailerProductActivitiesFormNew')}}" class="btn btn-link btn-float has-text">
                            <i class="icon-plus2"></i>
                            <span>Nuevo Asignaci&oacute;n</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr />
        <div class="panel-body ">
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Actividades</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entities as $productActivities)
                        <tr>
                            <td><!--{{ $productActivities->ad_retailer_product_id }}-->
                                <a href="{{ route('retailerProductActivitiesFormEdit', ['id'=>$productActivities->ad_retailer_product_id ]) }}" title="Editar">
                                    {{ $productActivities->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{route('create_modal_list_occupation', ['id_retailer_product'=>$productActivities->ad_retailer_product_id, 'text'=>'slip'])}}" id="list" rel="{{ $productActivities->name }}" class="btn btn-success open_modal_list">
                                    <i class="icon-file-text2 position-left"></i> Lista de ocupaciones agregadas
                                </a>
                            </td>
                            <td class="text-center">
                                <a onclick="FormGralF.deleteElement('{{ route('retailerProductActivitiesFormDestroy', ['id'=>$productActivities->ad_retailer_product_id ]) }}','')" title="Eliminar"><i class="icon-trash"></i></a>&nbsp;
                                <a href="{{ route('retailerProductActivitiesFormEdit', ['id'=>$productActivities->ad_retailer_product_id ]) }}" title="Editar"><i class="icon-pencil"></i></a>&nbsp;
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
            <div class="text-right">
                <a href="{{route('adActivitiesList')}}" class="btn btn-primary">
                    Administrar Actividades <i class="icon-arrow-right14"></i>
                </a>    
            </div>
        </div>
    </div>

    <div id="prueba_modal" class="modal fade">
        <div class="modal-dialog" style="width: 780px;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title main-title"></h6>
                </div>
                <div class="modal-body" id="respuesta">
                    <p>One fine body&hellip;</p>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        /*FUNCTION EASY LOADING*/
        function easyLoading (element, theme, show) {
            if (show) {
                $(element).loading({
                    theme: theme,                  //light
                    message: 'Por favor espere...'
                });
            }

            if (! show) {
                $(element).loading('stop');
            }
        }
    </script>

@endsection