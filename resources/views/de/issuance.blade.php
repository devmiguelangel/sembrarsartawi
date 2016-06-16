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
                            class="text-semibold">Seguro de Desgravamen</span></h4>

                <ul class="breadcrumb breadcrumb-caret position-right">
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Desgravamen</a></li>
                    <li class="active">Cotizar</li>
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
                                        <span class="number">1</span> Datos del Prestamo
                                    </a>
                                </li>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">2</span>Datos del Titular
                                    </a>
                                </li>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">2</span>Resultado Cotización
                                    </a>
                                </li>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">2</span>Emisión de la Póliza de Desgravamen
                                    </a>
                                </li>
                                <li class="current" id="finish">
                                    <a href="#">
                                        <span class="current-info audible">current step: </span>
                                        <span class="number">5</span> Impresión de la Póliza
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
                <div class="clearfix"></div>
                @if(session('error_header'))
                    <script>
                        $(function () {
                            messageAction('error', "{{ session('error_header') }}");
                        });
                    </script>
                @endif

                @if(session('success_header'))
                    <script>
                        $(function () {
                            messageAction('succes', "{{ session('success_header') }}");
                        });
                    </script>
                @endif

                <div class="panel-body ">
                    <div class="col-md-4 col-md-offset-2">
                        <div class="modal-header bg-primary">
                            <h6 class="modal-title">Póliza {{ $header->prefix }} - {{ $header->issue_number }}</h6>
                        </div>
                        <div class="panel panel-body border-top-primary text-center">
                            <p class="text-muted content-group-sm">Certificados</p>
                            <div class="col-md-12">
                                <p>
                                    <a href="{{route('create_modal_slip', ['id_retailer_product'=>$rp_id, 'id_header'=>encode($header->id), 'text'=>'slip', 'type'=>'IMPR'])}}"
                                       id="slip" class="btn btn-info btn-labeled btn-xlg col-lg-12 open_modal">
                                        <b><i class="icon-printer4"></i></b> Ver Slip de Cotización
                                    </a>
                                </p>
                                <div class="col-md-6">&nbsp;</div>
                                <p>
                                    <a href="{{route('create_modal_slip', ['id_retailer_product'=>$rp_id, 'id_header'=>encode($header->id), 'text'=>'issuance', 'type'=>'IMPR'])}}"
                                       id="issuance" class="btn btn-info btn-labeled btn-xlg col-lg-12 open_modal">
                                        <b><i class="icon-printer4"></i></b> Ver Certificado de Emision
                                    </a>
                                </p>
                                <div class="col-md-6">&nbsp;</div>
                                <p>
                                    <a href="{{route('create_modal_slip', ['id_retailer_product'=>$rp_id, 'id_header'=>encode($header->id), 'text'=>'print_all', 'type'=>'IMPR'])}}"
                                       id="print_all" class="btn btn-primary btn-labeled btn-xlg col-lg-12 open_modal">
                                        <b><i class="icon-printer4"></i></b> Imprimir Todo
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    @if(! is_null($retailerProduct->subProducts))
                        <div class="col-md-4">
                            <div class="modal-header bg-success">
                                <h6 class="modal-title">Sub-Productos</h6>
                            </div>
                            <div class="panel panel-body border-top-primary text-center">
                                <p class="text-muted content-group-sm">Selecciona nuestros productos </p>
                                <div class="col-md-12">
                                    @foreach($retailerProduct->subProducts as $subProduct)
                                        @if ($subProduct->companyProduct->product->code === 'vi')
                                            <p>
                                                <a href="{{ route('de.vi.sp.list', [
                                              'rp_id'     => $rp_id,
                                              'header_id' => $header_id,
                                              'sp_id'     => encode($subProduct->productCompany->id)
                                            ]) }}"
                                                   class="btn btn-default col-lg-12 btn-xlg">
                                                    <i class="icon-hyperlink"></i> {{ $subProduct->companyProduct->product->name }}
                                                </a>
                                            </p>
                                            <div class="col-md-6">&nbsp;</div>

                                            @var $clientVi = false

                                            @foreach ($header->details as $detail)
                                                @if ($detail->client->detailsVi->count() > 0)
                                                    @var $clientVi = true
                                                @endif
                                            @endforeach

                                            @if ($clientVi)
                                                <p>
                                                    <a href="{{route('create_modal_slip', ['id_retailer_product'=>encode($subProduct->productCompany->id), 'id_header'=>encode($header->id), 'text'=>'issuance', 'type'=>'IMPR'])}}"
                                                       id="issuance"
                                                       class="btn btn-success btn-labeled btn-xlg col-lg-12 open_modal">
                                                        <b><i class="icon-printer4"></i></b> Ver Certificado Vida Grupo
                                                    </a>
                                                </p>
                                                <div class="col-md-6">&nbsp;</div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-4">
                        <div class="modal-header bg-info">
                            <h6 class="modal-title">Garantías</h6>
                        </div>
                        <div class="panel panel-body border-top-primary text-center">
                            <div class="col-md-12" ng-controller="HeaderDeController">
                                @foreach($retailer->retailerProducts as $retailerProduct)
                                    @if($retailerProduct->type === 'MP' && $retailerProduct->warranty)
                                        @var $coverage = false;

                                        @if(! is_null($header->coverageWarranty))
                                            @if($retailerProduct->companyProduct->product->code === 'au' && ! is_null($header->coverageWarranty->au))
                                                @var $coverage = true;
                                            @elseif($retailerProduct->companyProduct->product->code === 'td' && ! is_null($header->coverageWarranty->td))
                                                @var $coverage = true;
                                            @endif
                                        @endif

                                        @if($coverage)
                                            <a href="#"
                                               class="btn btn-info btn-labeled btn-xlg col-lg-12"
                                               data-toggle="modal" data-target="#modal_general">
                                                <b><i class="icon-printer4"></i></b> Ver Certificado
                                                de {{ $retailerProduct->companyProduct->product->name }}
                                            </a>
                                        @else
                                            <p>
                                                <a href="{{ route($retailerProduct->companyProduct->product->code . '.coverage.create', [
                                                'rp_id' => encode($retailerProduct->id),
                                                'de_id' => $header_id,
                                                'rp_de' => $rp_id
                                            ]) }}" class="btn btn-default col-lg-12 btn-xlg"
                                                   ng-click="createCoverage($event)">
                                                    <i class="icon-hyperlink"></i> {{ $retailerProduct->companyProduct->product->name }}
                                                </a>
                                            </p>
                                        @endif

                                        <div class="col-md-6">&nbsp;</div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /horizotal form -->
        </div>
    </div>

    <!-- modal -->
    @include('partials.modal_content')
            <!-- /modal -->

@endsection
