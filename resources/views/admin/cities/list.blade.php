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
                Departamentos
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">

                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.cities.new', ['nav'=>'city', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Crear registro</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <div class="panel-body">

        </div>
        @if($query->count()>0)
            <table class="table datatable-basic">
                <thead>
                <tr>
                    <th>Departamento</th>
                    <th style="text-align: center;">Codigo</th>
                    <th style="text-align: center;">Tipo CI</th>
                    <th style="text-align: center;">Tipo Regional</th>
                    <th style="text-align: center;">Tipo Departamento</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($query as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td style="text-align: center;">{{$data->abbreviation}}</td>
                        <td style="text-align: center;">
                            @if((boolean)$data->type_ci==true)
                                <input type="checkbox" class="styled tipoci" name="tipoci-{{$data->id}}" id="ci-{{$data->id}}" value="{{$data->id}}" checked>
                            @else
                                <input type="checkbox" class="styled tipoci" name="tipoci-{{$data->id}}" id="ci-{{$data->id}}" value="{{$data->id}}">
                            @endif
                        </td>
                        <td style="text-align: center;">
                            @if((boolean)$data->type_re==true)
                                <input type="checkbox" class="styled tipore" name="tipore-{{$data->id}}" id="re-{{$data->id}}" value="{{$data->id}}" checked>
                            @else
                                <input type="checkbox" class="styled tipore" name="tipore-{{$data->id}}" id="re-{{$data->id}}" value="{{$data->id}}">
                            @endif
                        </td>
                        <td style="text-align: center;">
                            @if((boolean)$data->type_de==true)
                                <input type="checkbox" class="styled tipode" name="tipode-{{$data->id}}" id="de-{{$data->id}}" value="{{$data->id}}" checked>
                            @else
                                <input type="checkbox" class="styled tipode" name="tipode-{{$data->id}}" id="de-{{$data->id}}" value="{{$data->id}}">
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
                                            <a href="{{route('admin.cities.edit', ['nav'=>'city', 'action'=>'edit', 'id_depto'=>$data->id])}}">
                                                <i class="icon-pencil3"></i><i class="icon-drawer-in"></i>Editar/Agregar a Retailer
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
                <span class="text-semibold">Warning!</span> No existe ningun registro, ingrese un nuevo registro.
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //CHECKBOX TIPO CI
            $('.tipoci').click(function(){
                var id_depto = $(this).prop('value');
                //alert(id_depto);
                if($('#ci-'+id_depto).is(":checked")){
                    var answer='v';
                }else{
                    var answer='f';
                }
                //alert(answer+' '+id_depto);
                $.get( "{{url('/')}}/admin/cities/typeci_ajax/"+id_depto+"/"+answer, function( data ) {
                    console.log(data);
                    if(data==1){
                        bootbox.alert("Se actualizo correctamente los datos tipo CI.");
                        window.setTimeout('location.reload()', 3000);
                    }else if(data==0){
                        bootbox.alert("Error no se actualizo el dato.");
                    }
                });
            });

            //CHECKBOX TIPO REGIONAL
            $('.tipore').click(function(){
                var id_depto = $(this).prop('value');
                //alert(id_depto);
                if($('#re-'+id_depto).is(":checked")){
                    var answer='v';
                }else{
                    var answer='f';
                }
                //alert(answer+' '+id_depto);
                $.get( "{{url('/')}}/admin/cities/typere_ajax/"+id_depto+"/"+answer, function( data ) {
                    console.log(data);
                    if(data==1){
                        bootbox.alert("Se actualizo correctamente los datos tipo Regional.");
                        window.setTimeout('location.reload()', 3000);
                    }else if(data==0){
                        bootbox.alert("Error no se actualizo el dato.");
                    }
                });
            });

            //CHECKBOX TIPO DEPARTAMENTO
            $('.tipode').click(function(){
                var id_depto = $(this).prop('value');
                //alert(id_depto);
                if($('#de-'+id_depto).is(":checked")){
                    var answer='v';
                }else{
                    var answer='f';
                }
                //alert(answer+' '+id_depto);
                $.get( "{{url('/')}}/admin/cities/typede_ajax/"+id_depto+"/"+answer, function( data ) {
                    console.log(data);
                    if(data==1){
                        bootbox.alert("Se actualizo correctamente los datos tipo Departamento.");
                        window.setTimeout('location.reload()', 3000);
                    }else if(data==0){
                        bootbox.alert("Error no se actualizo el dato.");
                    }
                });
            });
        });
    </script>
@endsection