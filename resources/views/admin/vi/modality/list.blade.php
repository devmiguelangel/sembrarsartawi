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
                Modalidades
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.vi.modality.new', ['nav'=>'modality', 'action'=>'new', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar nueva <br>modalidad</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.partials.message')
        </div>
        @if(count($query_list)>0)
            <table class="table table-bordered table-striped table-hover dataTable no-footer">
                <thead>
                <tr>
                    <th>Orden</th>
                    <th>Modalidad</th>
                    <th>Rango Mínimo</th>
                    <th>Rango Máximo</th>
                    <th>Valor Asegurado</th>
                    <th>Monto Mínimo</th>
                    <th>Monto Máximo</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @var $parameter = config('base.sp_modalities');
                @var $sw=true
                @foreach($query_list as $data)
                    @if($data->modality=='MV')
                        @if($sw == true)
                            @var $rowSpan = $num_records

                        @else
                            @var $rowSpan = ''
                        @endif
                    @endif
                    <tr>
                        <td>{{$data->order}}</td>
                        <td>{{$parameter[$data->modality]}}</td>
                        <td>{{$data->rank_min}}</td>
                        <td>{{$data->rank_max}}</td>
                        <td>{{$data->amount}}</td>
                        <td>{{$data->amount_min}}</td>
                        <td>{{$data->amount_max}}</td>
                        @if($data->modality=='MV' && $sw==true)
                            @var $sw=false
                            <td rowspan="{{$rowSpan}}">
                                @if((boolean)$data->active==true)
                                    <a href="#" id="{{$data->id}}|{{$data->modality}}|inactive|desactivar" class="confirm_active activar">
                                        <span class="label label-success">Activo</span>
                                    </a>
                                @elseif((boolean)$data->active==false)
                                    <a href="#" id="{{$data->id}}|{{$data->modality}}|active|activar" class="confirm_active desactivar">
                                        <span class="label label-default">Inactivo</span>
                                    </a>
                                @endif
                            </td>
                        @elseif($data->modality=='MS')
                            <td>
                                @if((boolean)$data->active==true)
                                    <a href="#" id="{{$data->id}}|{{$data->modality}}|inactive|desactivar" class="confirm_active activar">
                                        <span class="label label-success">Activo</span>
                                    </a>
                                @elseif((boolean)$data->active==false)
                                    <a href="#" id="{{$data->id}}|{{$data->modality}}|active|activar" class="confirm_active desactivar">
                                        <span class="label label-default">Inactivo</span>
                                    </a>
                                @endif
                            </td>
                        @endif
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="{{route('admin.vi.modality.edit', ['nav'=>'modality', 'action'=>'edit', 'id_retailer_product'=>$id_retailer_product, 'id_modality'=>$data->id])}}">
                                                <i class="icon-pencil3"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="confirm_delete" id="{{$data->id}}">
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
                <span class="text-semibold"></span> No existe ninguna modalidad registrada
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);

            $(".activar").mouseover(function(){
                $(this).find("span").removeClass('label label-success').addClass('label label-default').text("desactivar");
            });
            $(".activar").mouseout(function(){
                $(this).find("span").removeClass('label label-default').addClass('label label-success').text("Activo");
            });

            $(".desactivar").mouseover(function(){
                $(this).find("span").removeClass('label label-default').addClass('label label-success').text("activar");
            });
            $(".desactivar").mouseout(function(){
                $(this).find("span").removeClass('label label-success').addClass('label label-default').text("Inactivo");
            });

            //ELIMINAR REGISTRO
            $('a[href].confirm_delete').click(function(e){
                var id_modality = $(this).prop('id');
                bootbox.confirm("Esta seguro de eliminar la modalidad?", function(result) {
                    if(result){
                        $.get( "{{url('/')}}/admin/vi/modality/delete_ajax/"+id_modality, function( data ) {
                            //console.log(data);
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

            //ACTIVAR DESACTIVAR REGISTRO
            $('a[href].confirm_active').click(function(e){
                var _id = $(this).prop('id');
                var arr = _id.split('|');
                var id_modality = arr[0];
                var modality_code = arr[1];
                var text = arr[2];
                bootbox.confirm("Esta seguro de "+arr[3]+" la modalidad ?", function(result) {
                    if(result){
                        $.get( "{{url('/')}}/admin/vi/modality/active_ajax/"+id_modality+"/"+modality_code+"/"+text, function( data ) {
                            //console.log(data);
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