@extends('layout')

@section('header')
    @include('partials.header-home')
@endsection

@section('menu-main')
    @include('partials.menu-main')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal form -->
            <div class="panel panel-flat border-top-primary">
                <div class="wrapper no-pad" >
                    <!--mail inbox start-->
                    <div class="mail-box">
                        <aside class="sm-side">
                            <div class="m-title">
                                <h3>Mis casos facultativos</h3>
                                <span>4 Casos no atendidos</span>
                            </div>
                            <div class="inbox-body">
                                <a class="btn btn-compose" href="inbox-compose.html">
                                    Desgravamen
                                </a>
                            </div>
                            <ul class="inbox-nav inbox-divider">
                                <li class="active">
                                    <a href="#"><i class="icon-inbox"></i> Bandeja de entrada <span class="label label-info pull-right">10</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-check"></i> Aprobados <span class="label label-primary pull-right">2</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-trash"></i> Rechazados <span class="label label-primary pull-right">2</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-clock-o"></i> Observados <span class="label label-primary pull-right">2</span></a>
                                </li>
                                
                            </ul>
                            <div class="inbox-body success">
                                <a class="btn btn-compose2" href="inbox-compose.html">
                                    Automotores
                                </a>
                            </div>
                            <ul class="inbox-nav inbox-divider">
                                <li class="active">
                                    <a href="#"><i class="icon-inbox"></i> Bandeja de entrada <span class="label label-info pull-right">30</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-check"></i> Aprobados <span class="label label-primary pull-right">10</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-trash"></i> Rechazados <span class="label label-primary pull-right">5</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-clock-o"></i> Observados <span class="label label-primary pull-right">2</span></a>
                                </li>
                                
                            </ul>
                            <div class="inbox-body text-center">
                                <div class="btn-group">
                                    <a href="javascript:;" class="btn btn-default">
                                        <i class="icon-switch"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-default">
                                        <i class="icon-cog3"></i>
                                    </a>
                                </div>
                            </div>
                        </aside>
                        <aside class="lg-side" style="height: 1200px">
                            <div class="inbox-head">
                                <div class="mail-option">
                                    <div class="btn-group">
                                        <a class="btn mini tooltips" href="#"  data-popup="tooltip" data-original-title="Actualizar">
                                            <i class=" icon-loop3"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn" href="#" data-popup="tooltip" data-original-title="Aprobados">
                                            <i class="icon-check"></i>
                                        </a>
                                        <a class="btn" href="#" data-popup="tooltip" data-original-title="Rechazados">
                                            <i class="icon-trash"></i>
                                        </a>
                                        <a class="btn" href="#" data-popup="tooltip" data-original-title="Observados">
                                            <i class="fa fa-clock-o"></i>
                                        </a>
                                    </div>
                                    
                                    <ul class="unstyled inbox-pagination">
                                        <li><span class="label label-danger pull-right">&nbsp;</span><span>Mayor a 10 d&iacute;as</span></li>
                                        <li><span class="label label-warning pull-right">&nbsp;</span><span>3 a 10 d&iacute;as</span></li>
                                        <li><span class="label label-success pull-right">&nbsp;</span><span>0 a 2 d&iacute;as</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="inbox-body no-pad">
                                <table class="table table-inbox table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Dias en Proceso</th>
                                            <th>Nombre Completo</th>
                                            <th>Carnet</th>
                                            <th>Fecha de Ingreso</th>
                                            <th>Adjunto</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="unread">
                                            <td class="inbox-small-cells te">
                                                <label class="chek_inbox">
                                                    <input type="checkbox" class="styled">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <a href="#" class="avatar">
                                                    <span class="bg-success">2</span>
                                                </a>
                                            </td>
                                            <td class="view-message  dont-show">Vector Lab Lafuente <span class="label label-primary pull-right">Rechazado</span></td>
                                            <td class="view-message ">4565458 LP</td>
                                            <td class="view-message ">2015/01/31 9:27 AM</td>
                                            <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                            <td class="view-message  text-right" style="z-index:34;">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right" style="z-index:100;">
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Estado</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Observacion</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Marar como no leido</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Ver Certificado de desgravamen</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="unread">
                                            <td class="inbox-small-cells te">
                                                <label class="chek_inbox">
                                                    <input type="checkbox" class="styled">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <a href="#" class="avatar">
                                                    <span class="bg-warning">5</span>
                                                </a>
                                            </td>
                                            <td class="view-message  dont-show">Andres Mamani Quispe <span class="label label-primary pull-right">Aprobado</span></td>
                                            <td class="view-message ">4565458 LP</td>
                                            <td class="view-message ">2015/01/31 9:27 AM</td>
                                            <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                            <td class="view-message  text-right">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Estado</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Observacion</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Marar como no leido</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Ver Certificado de desgravamen</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="inbox-small-cells te">
                                                <label class="chek_inbox">
                                                    <input type="checkbox" class="styled">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <a href="#" class="avatar">
                                                    <span class="bg-warning">8</span>
                                                </a>
                                            </td>
                                            <td class="view-message  dont-show">Juan Mendoza Medrano <span class="label label-primary pull-right">Observado</span></td>
                                            <td class="view-message ">4565458 LP</td>
                                            <td class="view-message ">2015/01/31 9:27 AM</td>
                                            <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                            <td class="view-message  text-right">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Estado</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Observacion</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Marar como no leido</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Ver Certificado de desgravamen</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="inbox-small-cells te">
                                                <label class="chek_inbox">
                                                    <input type="checkbox" class="styled">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <a href="#" class="avatar">
                                                    <span class="bg-danger">12</span>
                                                </a>
                                            </td>
                                            <td class="view-message  dont-show">Daniel Salas</td>
                                            <td class="view-message ">4565458 LP</td>
                                            <td class="view-message ">2015/01/31 9:27 AM</td>
                                            <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                            <td class="view-message  text-right">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Estado</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Observacion</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Marar como no leido</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Ver Certificado de desgravamen</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="inbox-small-cells te">
                                                <label class="chek_inbox">
                                                    <input type="checkbox" class="styled">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <a href="#" class="avatar">
                                                    <span class="bg-success">1</span>
                                                </a>
                                            </td>
                                            <td class="view-message  dont-show">Jose Gutierrez</td>
                                            <td class="view-message ">4565458 LP</td>
                                            <td class="view-message ">2015/01/31 9:27 AM</td>
                                            <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                            <td class="view-message  text-right">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Estado</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Observacion</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Marar como no leido</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Ver Certificado de desgravamen</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="inbox-small-cells te">
                                                <label class="chek_inbox">
                                                    <input type="checkbox" class="styled">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <a href="#" class="avatar">
                                                    <span class="bg-success">2</span>
                                                </a>
                                            </td>
                                            <td class="view-message  dont-show">Juaquin Mascaro Lozano</td>
                                            <td class="view-message ">4565458 LP</td>
                                            <td class="view-message ">2015/01/31 9:27 AM</td>
                                            <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                            <td class="view-message  text-right">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Estado</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Observacion</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Marar como no leido</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Ver Certificado de desgravamen</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="inbox-small-cells te">
                                                <label class="chek_inbox">
                                                    <input type="checkbox" class="styled">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <a href="#" class="avatar">
                                                    <span class="bg-warning">7</span>
                                                </a>
                                            </td>
                                            <td class="view-message  dont-show">David Limber Mamani</td>
                                            <td class="view-message ">4565458 LP</td>
                                            <td class="view-message ">2015/01/31 9:27 AM</td>
                                            <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                            <td class="view-message  text-right">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Estado</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Observacion</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Marar como no leido</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Ver Certificado de desgravamen</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="unread">
                                            <td class="inbox-small-cells te">
                                                <label class="chek_inbox">
                                                    <input type="checkbox" class="styled">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <a href="#" class="avatar">
                                                    <span class="bg-warning">9</span>
                                                </a>
                                            </td>
                                            <td class="view-message  dont-show">Jose Quispe Medrano <span class="label label-primary pull-right">Rechazado</span></td>
                                            <td class="view-message ">4565458 LP</td>
                                            <td class="view-message ">2015/01/31 9:27 AM</td>
                                            <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                            <td class="view-message  text-right" style="z-index:34;">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right" style="z-index:100;">
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Estado</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Observacion</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Marar como no leido</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Ver Certificado de desgravamen</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="unread">
                                            <td class="inbox-small-cells te">
                                                <label class="chek_inbox">
                                                    <input type="checkbox" class="styled">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <a href="#" class="avatar">
                                                    <span class="bg-success">1</span>
                                                </a>
                                            </td>
                                            <td class="view-message  dont-show">Lorena Paz Guitierrez <span class="label label-primary pull-right">Aprobado</span></td>
                                            <td class="view-message ">4565458 LP</td>
                                            <td class="view-message ">2015/01/31 9:27 AM</td>
                                            <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                            <td class="view-message  text-right">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Estado</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Observacion</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Marar como no leido</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Ver Certificado de desgravamen</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="inbox-small-cells te">
                                                <label class="chek_inbox">
                                                    <input type="checkbox" class="styled">
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <a href="#" class="avatar">
                                                    <span class="bg-warning">10</span>
                                                </a>
                                            </td>
                                            <td class="view-message  dont-show">Sandra Mamani Quispe <span class="label label-primary pull-right">Observado</span></td>
                                            <td class="view-message ">4565458 LP</td>
                                            <td class="view-message ">2015/01/31 9:27 AM</td>
                                            <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                            <td class="view-message  text-right">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Estado</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Observacion</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Marar como no leido</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="icon-plus2"></i> Ver Certificado de desgravamen</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </aside>
                    </div>
                    <!--mail inbox end-->
                </div>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection