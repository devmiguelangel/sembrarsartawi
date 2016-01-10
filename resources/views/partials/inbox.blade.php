<div class="mail-box">
    <aside class="sm-side">
        <div class="m-title">
            <h3>Mis casos facultativos</h3>
            <span>4 Casos no atendidos</span>
        </div>
        <div id="accordion" class="panel-group" aria-multiselectable="true" role="tablist">
            @foreach ($data['products'] as $index => $product)
                <div class="panel panel-default">
                    <div role="tab"> 
                        <div class="inbox-body">
                            <a class="btn btn-compose" aria-controls="collapseOne" aria-expanded="true" href="#collapse-{{ $index }}" data-parent="#accordion" data-toggle="collapse" role="button">
                                {{ $product->name }}
                            </a>
                        </div>
                    </div> 
                    <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse in" id="collapse-{{ $index }}" aria-expanded="true" style=""> 
                        <ul class="inbox-nav inbox-divider">
                            <li class="active">
                                <a href="#">
                                    <i class="icon-inbox"></i> Bandeja de entrada 
                                    <span class="label label-info pull-right">{{ count($product->records['all-unread']) }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-check"></i> Aprobados 
                                    <span class="label label-primary pull-right">{{ count($product->records['approved-unread']) }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-clock-o"></i> Observados 
                                    <span class="label label-primary pull-right">{{ count($product->records['observed-unread']) }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-trash"></i> Rechazados 
                                    <span class="label label-primary pull-right">{{ count($product->records['rejected-unread']) }}</span>
                                </a>
                            </li>
                        </ul> 
                    </div>
                </div>
            @endforeach
            
            {{-- <div class="panel panel-default"> 
                <div id="headingTwo" role="tab" > 
                    <div class="inbox-body success">
                        <a class="btn btn-compose2 collapsed" aria-controls="collapseTwo" aria-expanded="false" href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" role="button">
                            Automotores
                        </a>
                    </div>
                </div> 
                <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse" id="collapseTwo" aria-expanded="false" style="height: 0px;"> 

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


                </div> 
            </div> --}}
        </div> 
        
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
                    <li><span class="label label-danger pull-right">&nbsp;</span><span>Mayor a 10 días </span></li>
                    <li><span class="label label-warning pull-right">&nbsp;</span><span>3 a 10 días </span></li>
                    <li><span class="label label-success pull-right">&nbsp;</span><span>0 a 2 días </span></li>
                </ul>
            </div>
        </div>
        <div id="inbox" class="inbox-body no-pad">
            <table class="table table-inbox table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>Días en Proceso</th>
                        <th>Cliente</th>
                        <th>C.I.</th>
                        <th>Fecha de Ingreso</th>
                        <th>Adjunto</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['products'][0]->records['all'] as $record)
                        <tr class="{{ ! $record->read ? 'unread' : '' }}">
                            <td class="inbox-small-cells te">
                                <label class="chek_inbox">
                                    <input type="checkbox" class="styled" {{ ! $record->read ? 'checked' : '' }}>
                                </label>
                            </td>
                            <td class="inbox-small-cells">
                                <a href="#" class="avatar">
                                    <span class="bg-success">2</span>
                                </a>
                            </td>
                            <td class="view-message  dont-show">
                                {{ $record->detail->client->full_name }}
                                <span class="label label-primary pull-right">Rechazado</span></td>
                            <td class="view-message ">
                                {{ $record->detail->client->dni }} {{ $record->detail->client->extension }}
                            </td>
                            <td class="view-message ">{{ date('d/m/Y H:i A', strtotime($record->created_at)) }}</td>
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
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </aside>
</div>