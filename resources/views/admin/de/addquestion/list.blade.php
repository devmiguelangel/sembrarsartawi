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
                Cuestionario médico Desgravamen
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">

                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.de.addquestion.new', ['nav'=>'addquestion', 'action'=>'new', 'id_retailer_product'=>$id_retailer_product])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Agregar pregunta</span>
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
        @if(count($query_list_q)>0)
            <table class="table datatable-basic">
            <thead>
            <tr>
                <th>Nro</th>
                <th>Pregunta</th>
                <th style="text-align: center;">Respuesta esperada</th>
                <th style="text-align: center;">Estado</th>
                <th class="text-center">Accion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($query_list_q as $data)
                <tr>
                <td style="text-align: left;">{{$data->order}}</td>
                <td style="text-align: left;">{{$data->question}}</td>
                <td style="text-align: center;">
                    @if((boolean)$data->response==true)
                        SI
                    @else
                        NO
                    @endif
                </td>
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
                                <li><a href="{{route('admin.de.addquestion.edit', ['nav'=>'addquestion', 'action'=>'edit', 'id_retailer_product_question'=>$data->id, 'id_retailer_product'=>$id_retailer_product])}}"><i class="icon-pencil3"></i> Editar</a></li>
                                @if((boolean)$data->active==true)
                                    <li>
                                        <a href="#" id="{{$data->id}}|inactive|desactivar|{{$data->order}}" class="confirm_active">
                                            <i class="icon-cross"></i> Desactivar
                                        </a>
                                    </li>
                                @elseif((boolean)$data->active==false)
                                    <li>
                                        <a href="#" id="{{$data->id}}|active|activar|{{$data->order}}" class="confirm_active">
                                            <i class="icon-checkmark4"></i> Activar
                                        </a>
                                    </li>
                                @endif
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
                <span class="text-semibold">Warning!</span> No existe ningun registro, ingrese un nuevo registro.
            </div>
        @endif
    </div>
    <script type="text/javascript">
        setTimeout(function() {
            $('#message-session').fadeOut();
        }, 3000);

        $(document).ready(function(){
            $('a[href].confirm_active').click(function(e){

                var _id = $(this).prop('id');
                var arr = _id.split("|");
                var id_retailer_product_question = arr[0];
                var text = arr[1];
                bootbox.confirm("Esta seguro de "+arr[2]+" la pregunta "+arr[3]+"?", function(result) {
                    if(result){
                        //bootbox.alert("Confirm result: " + result+ "/" +id_user);
                        $.get( "{{url('/')}}/admin/de/addquestion/active_ajax/"+id_retailer_product_question+"/"+text, function( data ) {
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