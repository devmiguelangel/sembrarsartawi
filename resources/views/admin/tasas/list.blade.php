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

    @if($type_product!='RP')
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="form-wizard-title text-semibold" style="border-bottom: 0px;">
                    <span class="form-wizard-count"><i class="icon-file-text2"></i></span>
                    Tasas agregadas producto {{$product_query->name}}
                    <small class="display-block">Listado de registros</small>
                </h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li>
                            <a href="{{route('admin.tasas.new', ['nav'=>'rate', 'action'=>'new', 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product, 'type'=>$type, 'type_product'=>$type_product])}}" class="btn btn-link btn-float has-text">
                                <i class="icon-file-plus text-primary"></i>
                                <span>Agregar tasa</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                @include('admin.partials.message')
            </div>
            @if(count($query)>0)

                @if(in_array($code_product, array('de','vi','td')))

                    <table class="table table-bordered table-striped table-hover dataTable no-footer">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            @if($type=='coverage')
                                <th>Cobertura</th>
                                @endif
                                        <!--
                            <th>Tasa Compañía</th>
                            <th>Tasa Banco</th>
                            -->
                                <th>Tasa final</th>
                                <th>Retailer</th>
                                <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($query as $data)
                            <tr>
                                <td>{{$data->product}}</td>
                                @if($type=='coverage')
                                    <td>{{$data->coverage}}</td>
                                    @endif
                                            <!--
                            <td>{{$data->rate_company}}</td>
                            <td>{{$data->rate_bank}}</td>
                            -->
                                    <td>{{$data->rate_final}}</td>
                                    <td>{{$data->retailer}}</td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="{{route('admin.tasas.edit', ['nav'=>'rate', 'action'=>'edit', 'id_rates'=>$data->id_rates, 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product, 'type'=>$type, 'type_product'=>$type_product])}}">
                                                            <i class="icon-pencil3"></i> Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="confirm_delete" id="{{$data->id_rates}}">
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

                @elseif(in_array($code_product, array('au')))
                    @var $cont = 0
                    <table class="table table-bordered table-striped table-hover dataTable no-footer">
                        <thead>
                        <tr>
                            <th>Tasa</th>
                            <th>Tasa Categoria A</th>
                            <th>Tasa Categoria B</th>
                            <th>Año</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($query as $data)
                            @var $vec = explode('|',$data)
                            <tr>
                                <td>{{$vec[1]}}</td>
                                <td>{{$vec[5]}}</td>
                                <td>{{$vec[8]}}</td>
                                <td>{{$vec[2]}}</td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{route('admin.tasas.edit', ['nav'=>'rate', 'action'=>'edit', 'id_rates'=>$vec[0], 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product, 'type'=>$type])}}">
                                                        <i class="icon-pencil3"></i> Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="confirm_delete" id="{{$vec[0]}}|{{$code_product}}">
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
                @endif
            @else
                <div class="alert alert-warning alert-styled-left">
                    <span class="text-semibold"></span> No existe ninguna tasa registrada
                </div>
            @endif
        </div>
    @endif
    <!-- hipotecario -->
    @if($code_product=='de')
        @if(count($query_quest_pa)==0)
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Desgravamen Hipotecario</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li>
                                @if(count($query_hipotecario)==0)
                                    <a href="{{route('admin.tasas.new-mortgage', ['nav'=>'rate', 'action'=>'new', 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product, 'type'=>$type, 'type_product'=>$type_product])}}" class="btn btn-link btn-float has-text">
                                        <i class="icon-file-plus text-primary"></i>
                                        <span>Agregar tasa <br>desgravamen hipotecario</span>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    @include('admin.partials.message')
                </div>
                @if(count($query_hipotecario)>0)
                    <table class="table table-bordered table-striped table-hover dataTable no-footer">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Tasa</th>
                            <th>Producto Crediticio</th>
                            <th>Retailer</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($query_hipotecario as $data_hipot)
                            <tr>
                                <td>{{$data_hipot->product}}</td>
                                <td>{{$data_hipot->rate_final}}</td>
                                <td>{{$data_hipot->product_credit}}</td>
                                <td>{{$data_hipot->retailer}}</td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{route('admin.tasas.edit-mortgage', ['nav'=>'rate', 'action'=>'edit', 'id_rates'=>$data_hipot->id_rates, 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product, 'type'=>$type, 'type_product'=>$type_product])}}">
                                                        <i class="icon-pencil3"></i> Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="confirm_delete" id="{{$data_hipot->id_rates}}">
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
                    <div class="alert alert-danger alert-styled-left alert-bordered">
                        <span class="text-semibold"></span> Ingrese la tasa hipotecaria
                    </div>
                @endif
            </div>
        @elseif($type_product=='RP')
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Desgravamen Hipotecario</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li>
                                @if(count($query_hipotecario)==0)
                                    <a href="{{route('admin.tasas.new-mortgage', ['nav'=>'rate', 'action'=>'new', 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product, 'type'=>$type, 'type_product'=>$type_product])}}" class="btn btn-link btn-float has-text">
                                        <i class="icon-file-plus text-primary"></i>
                                        <span>Agregar tasa <br>desgravamen hipotecario</span>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    @include('admin.partials.message')
                </div>
                @if(count($query_hipotecario)>0)
                    <table class="table table-bordered table-striped table-hover dataTable no-footer">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Tasa</th>
                            <th>Producto Crediticio</th>
                            <th>Retailer</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($query_hipotecario as $data_hipot)
                            <tr>
                                <td>{{$data_hipot->product}}</td>
                                <td>{{$data_hipot->rate_final}}</td>
                                <td>{{$data_hipot->product_credit}}</td>
                                <td>{{$data_hipot->retailer}}</td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{route('admin.tasas.edit-mortgage', ['nav'=>'rate', 'action'=>'edit', 'id_rates'=>$data_hipot->id_rates, 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product, 'type'=>$type])}}">
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
                    <div class="alert alert-danger alert-styled-left alert-bordered">
                        <span class="text-semibold"></span> Ingrese la tasa hipotecaria
                    </div>
                @endif
            </div>
        @endif
    @endif
    <!-- /hipotecario -->

    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function() {
                $('#message-session').fadeOut();
            }, 3000);

            $('a[href].confirm_delete').click(function(e){

                var _id = $(this).prop('id');
                var vec = _id.split('|');
                var id_rates = vec[0];
                var code_product = vec[1];
                //var id_rates = $(this).prop('id');

                bootbox.confirm("Esta seguro de eliminar el registro ?", function(result) {
                    if(result){
                        $.get( "{{url('/')}}/admin/tasas/delete_ajax/"+id_rates+"/"+code_product, function( result ) {
                            //console.log(result);

                            if(result['response']=='ok'){
                                swal({
                                    title: result['detail'],
                                    confirmButtonColor: "#2196F3"
                                });
                                window.setTimeout('location.reload()', 2000);
                            }else if(result['response']=='error'){
                                swal({
                                    title: "Error!! "+result['detail'],
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