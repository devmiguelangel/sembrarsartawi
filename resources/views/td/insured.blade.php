@extends('layout')

@section('header')
    @include('partials.header-home')
@endsection

@section('menu-main')
    @include('partials.menu-main')
@endsection

@section('menu-header')
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span
                    class="text-semibold">Seguro de Multiriesgo</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="">Inicio</a></li>
                <li><a href="">Datos del Cliente</a></li>
                <li class="active">Datos del Iteres Asegurado</li>
            </ul>
        </div>

    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal form -->
        <div class="panel panel-flat border-top-primary">
            <div class="panel-heading divhr">
                <div class="steps-basic2 wizard">
                    <div class="steps">
                        <ul>
                            <li class="first done">
                                <a href="#">
                                    <span class="number">1</span> Datos del Cliente
                                </a>
                            </li>
                            <li class="current">
                                <a href="#">
                                    <span class="number">2</span> Datos del Interes Asegurado
                                </a>
                            </li>
                            <li class="disabled last">
                                <a href="#">
                                    <span class="number">3</span> Resultado Cotización
                                </a>
                            </li>
                            <li class="disabled last">
                                <a href="#">
                                    <span class="number">4</span> Emisión de Póliza Seguro de Multiriesgo
                                </a>
                            </li>
                            <li class="disabled last">
                                <a href="#">
                                    <span class="number">5</span> Impresion de la Póliza
                                </a>
                            </li>   
                        </ul>
                    </div>
                </div>
                <button style="float: right;" type="button" class="btn btn-rounded btn-default text-right"
                        title="Detalle de producto" data-placement="right" data-toggle="modal"
                        data-target="#modal_theme_primary">
                    <i class="icon-question7"></i> Producto
                </button>
            </div>

            @if(session('success_header'))
            <script>
                $(function() {
                    messageAction('succes', "{{ session('success_header') }}");
                });
            </script>
            @endif

            @if(session('error_header'))
            <script>
                $(function() {
                    messageAction('error', "{{ session('error_header') }}");
                });
            </script>
            @endif

            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">
                    <div class="modal-header bg-primary recuadro">
                        <div class="panel-heading">
                            <h6 class="modal-title">Interes Asegurado</h6>
                        </div>
                    </div>
                    <div class="panel panel-body border-top-success">
                        <div class="text-right">
                            <a href="#"
                               onclick="returnContent('{{ route('td.form.insured',['rp_id'=>$rp_id, 'header_id'=>decode($header_id), 'id_detail'=>0, 'steep'=>2])}}', 'GET');$('.modal-title').html('Riesgo Asegurado')"
                               data-toggle="modal" data-target="#modal_general" class="btn btn-primary text-left">
                                Nuevo <i class="glyphicon glyphicon-plus "></i>
                            </a>
                            <a class="list_content" onclick="listInsured('{{ route('td.list.insured',['rp_id'=>$rp_id,'header_id'=>$header_id, 'steep'=>2])}}', 'GET', '{{ $header_id }}');"></a>
                        </div>
                        <hr />
                        <div class="col-xs-12 col-md-12 " id="content_insured">
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Materia </th>
                                        <th>Descripción</th>
                                        <th>Número</th>
                                        <th>Uso</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <small>Puede registrar hasta {{ $prodParam->detail }} <strong>Intereses Asegurados</strong> como m&aacute;ximo.</small>
                </div>
                <div class="clearfix"></div>
                <div class="text-right">
                    <a href="{{ route('td.result_cot', ['rp_id'=>$rp_id, 'header_id'=>$header_id])}}" class="btn btn-primary">
                        Cotiza tu Mejor seguro <i class="glyphicon glyphicon-ok position-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /horizotal form -->
    </div>
</div>
<script>
$(document).ready(function() {    
$('.list_content').click();
});
</script>
<!-- modal -->
@include('partials.modal')
<!-- /modal -->
@endsection


