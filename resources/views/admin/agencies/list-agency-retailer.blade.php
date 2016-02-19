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
                Agencias  agregadas a departamento
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">
                <a href="{{route('admin.agencies.new-agency-retailer', ['nav'=>$nav, 'action'=>'new_agency_retailer'])}}" class="btn btn-link btn-float has-text">
                    <i class="icon-file-plus text-primary"></i>
                    <span>Agregar Agencias <br>a Departamento</span>
                </a>
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
            <table class="table datatable-basic table-bordered">
                <thead>
                <tr>
                    <th>Agencia</th>
                    <th>Departamento</th>
                    <th>Retailer</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($query as $data)
                    <tr>
                        <td>{{$data->agency}}</td>
                        <td>{{$data->city}}</td>
                        <td>{{$data->retailer}}</td>
                        <td>
                            @if((boolean)$data->active==true)
                                <span class="label label-success">Active</span>
                            @else
                                <span class="label label-default">Inactive</span>
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
                                            @if((boolean)$data->active==true)
                                                <a href="#" id="{{$data->id_retailer_city_agency}}|inactive|desactivar" class="confirm_active">
                                                    <i class="icon-cross2"></i> Desactivar
                                                </a>
                                            @else
                                                <a href="#" id="{{$data->id_retailer_city_agency}}|active|activar" class="confirm_active">
                                                    <i class="icon-checkmark4"></i> Activar
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
                <span class="text-semibold"></span> No existe agencias registradas a departamento.
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);

            $('a[href].confirm_active').click(function(e){

                var _id = $(this).prop('id');
                var arr = _id.split("|");
                var id_retailer_city_agency = arr[0];
                var text = arr[1];
                bootbox.confirm("Esta seguro de "+arr[2]+" el departamento ?", function(result) {
                    if(result){
                        //bootbox.alert("Confirm result: " + result+ "/" +id_user);
                        $.get( "{{url('/')}}/admin/cities/active_ajax/"+id_retailer_city_agency+"/"+text, function( data ) {
                            console.log(data);
                            if(data==1){
                                window.setTimeout('location.reload()', 1000);
                            }else if(data==0){
                                bootbox.alert("Error!! no se actualizo el dato, vuelva a intentarlo otra vez");
                            }
                        });
                    }
                });

            });
        });
    </script>
@endsection