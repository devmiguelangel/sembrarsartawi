<div class="mail-box" ng-controller="FacultativeController">
    <aside class="sm-side">
        <div class="m-title">
            <h3>Mis casos facultativos</h3>
            {{--<span>4 Casos no atendidos</span>--}}
        </div>
        <div id="accordion" class="panel-group" aria-multiselectable="true" role="tablist">
            @foreach ($data['products'] as $index => $product)
                <div class="panel panel-default">
                    <div role="tab">
                        <div class="inbox-body">
                            <a class="btn btn-compose collapsed" aria-controls="collapseOne" aria-expanded="false"
                               href="#collapse-{{ $index }}" data-parent="#accordion" data-toggle="collapse"
                               role="button">
                                {{ $product->name }}
                            </a>
                        </div>
                    </div>
                    <div aria-labelledby="headingOne" role="tabpanel"
                         class="panel-collapse collapse {{ (! is_null(request()->get('arp')) && encode($product->rp->id) === request()->get('arp')) || (is_null(request()->get('arp')) && $index === 0) ? 'in' : '' }}"
                         id="collapse-{{ $index }}" aria-expanded="true" style="">
                        <ul class="inbox-nav inbox-divider">
                            <li class="active">
                                <a href="{{ route('home', ['arp' => encode($product->rp->id), 'inbox' => 'all']) }}">
                                    <i class="icon-inbox"></i> Bandeja de entrada
                                    <span class="label label-info pull-right">{{ $product->records['all']->count() }}</span>
                                </a>
                            </li>

                            @if ($user->profile->first()->slug === 'SEP')
                                <li>
                                    <a href="{{ route('home', ['arp' => encode($product->rp->id), 'inbox' => 'approved']) }}">
                                        <i class="icon-check"></i> Aprobados
                                        <span class="label label-primary pull-right">
                                            {{ $product->records['approved']->count() }}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('home', ['arp' => encode($product->rp->id), 'inbox' => 'observed']) }}">
                                        <i class="fa fa-clock-o"></i> Observados
                                        <span class="label label-primary pull-right">
                                            {{ $product->records['observed']->count() }}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('home', ['arp' => encode($product->rp->id), 'inbox' => 'rejected']) }}">
                                        <i class="icon-trash"></i> Rechazados
                                        <span class="label label-primary pull-right">
                                            {{ $product->records['rejected']->count() }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </aside>

    <aside class="lg-side" style="height: 1200px">
        <div class="inbox-head">
            <div class="mail-option">
                <div class="btn-group">
                    <a class="btn mini tooltips" href="{{ request()->fullUrl() }}" data-popup="tooltip"
                       data-original-title="Actualizar">
                        <i class=" icon-loop3"></i>
                    </a>
                </div>

                @if ($user->profile->first()->slug === 'SEP')
                    <div class="btn-group">
                        <a class="btn"
                           href="{{ route('home', ['arp' => encode($product->rp->id), 'inbox' => 'approved']) }}"
                           data-popup="tooltip" data-original-title="Aprobados">
                            <i class="icon-check"></i>
                        </a>
                        <a class="btn"
                           href="{{ route('home', ['arp' => encode($product->rp->id), 'inbox' => 'observed']) }}"
                           data-popup="tooltip" data-original-title="Observados">
                            <i class="fa fa-clock-o"></i>
                        </a>
                        <a class="btn"
                           href="{{ route('home', ['arp' => encode($product->rp->id), 'inbox' => 'rejected']) }}"
                           data-popup="tooltip" data-original-title="Rechazados">
                            <i class="icon-trash"></i>
                        </a>
                    </div>
                @endif

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
                    <th>No. Certificado</th>
                    <th>Días en Proceso</th>
                    <th>Cliente</th>
                    <th>C.I.</th>
                    @if (count($data['products']) > 0)
                        @foreach($data['products'] as $index => $product)
                            @if((! is_null(request()->get('arp')) && encode($product->rp->id) === request()->get('arp'))
                                    || (is_null(request()->get('arp')) && $index === 0))

                                @if($product->code === 'td')
                                    <th>Tipo de Materia</th>
                                    <th>Descripción</th>
                                @endif

                            @endif
                        @endforeach
                    @endif
                    <th>Fecha de Ingreso</th>
                    <th class="text-center">Acción</th>
                </tr>
                </thead>
                <tbody>
                @if (count($data['products']) > 0)
                    @foreach($data['products'] as $index => $product)
                        @if((! is_null(request()->get('arp')) && encode($product->rp->id) === request()->get('arp'))
                                || (is_null(request()->get('arp')) && $index === 0))
                            @foreach ($product->records['inbox'] as $key => $record)
                                {{--<tr class="{{ ! $record->read ? 'unread' : '' }}">--}}
                                <tr ng-init="record[{{ $key }}].unread = readToBoolean({{ (int) $record->read }})"
                                    ng-class="{ unread: !record[{{ $key }}].unread }">
                                    <td class="inbox-small-cells te">
                                        <label class="chek_inbox">
                                            <input type="checkbox" class="styled"
                                                   ng-model="record[{{ $key }}].unread"
                                                   ng-click="readEdit($event, record[{{ $key }}].unread)"
                                                   data-slug="f{{ $product->code }}"
                                                   data-record="{{ encode($record->id) }}"
                                                   data-rp-id="{{ encode($product->rp->id) }}"
                                                    {{ $record->read ? 'checked' : '' }}>
                                        </label>
                                    </td>
                                    <td class="view-message">
                                        {{ $record->detail->header->certificate_number }}
                                    </td>
                                    <td class="inbox-small-cells">
                                        <a href="#" class="avatar">
                                            <span class="{{ $record->process_days <= 2 ? 'bg-success' : ($record->process_days <= 10 ? 'bg-warning' : 'bg-danger') }}">
                                              {{ $record->process_days }}
                                            </span>
                                        </a>
                                    </td>
                                    <td class="view-message  dont-show">
                                        @if($product->code === 'de')
                                            {{ $record->detail->client->full_name }}
                                        @else
                                            {{ $record->detail->header->client->full_name }}
                                            @if($product->code === 'au')
                                                <br>
                                                Vehículo:
                                                <span class="text-regular">{{ $record->detail->vehicleType->vehicle }}</span>
                                                <br>
                                                <span class="text-regular">{{ $record->detail->vehicleMake->make }}
                                                    - {{ $record->detail->vehicleModel->model }}</span>
                                                <br>
                                                Placa:
                                                <span class="text-regular">{{ $record->detail->license_plate }}</span>
                                            @endif
                                        @endif
                                        <br>
                                        <span class="label label-primary pull-right">{{ config('base.company_state.' . $record->company_state) }}</span>
                                    </td>
                                    <td class="view-message ">
                                        @if($product->code === 'de')
                                            {{ $record->detail->client->dni }} {{ $record->detail->client->extension }}
                                        @else
                                            {{ $record->detail->header->client->dni }} {{ $record->detail->header->client->extension }}
                                        @endif
                                    </td>
                                    @if($product->code === 'td')
                                        <td class="view-message ">{{ config('base.property_types.' . $record->detail->matter_insured) }}</td>
                                        <td class="view-message ">{{ config('base.property_uses.' . $record->detail->use) }}</td>
                                    @endif
                                    <td class="view-message ">{{ $record->date_admission }}</td>
                                    {{--<td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>--}}
                                    <td class="view-message  text-right" style="z-index:34;">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right" style="z-index:100;">
                                                    @if ($user->profile->first()->slug === 'SEP')
                                                        @if ($record->company_state === 'A' || $record->company_state === 'R')
                                                            <li>
                                                                <a href="{{ route($product->code . '.fa.observation.process', [
                                                                    'rp_id' => encode($product->rp->id),
                                                                    'id'    => encode($record->id),
                                                                ]) }}" ng-click="observation($event)">
                                                                    <i class="icon-plus2"></i>
                                                                    Respuesta
                                                                    ({{ config('base.company_state.' . $record->company_state) }}
                                                                    )
                                                                </a>
                                                            </li>

                                                            @if ($record->company_state === 'A' && $record->detail->header->approved)
                                                                <li>
                                                                    <a href="{{ route($product->code . '.issue', [
                                                                        'rp_id'     => encode($product->rp->id),
                                                                        'header_id' => encode($record->detail->header->id)
                                                                    ]) }}">
                                                                        <i class="icon-plus2"></i> Emitir Póliza
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endif
                                                    @elseif ($user->profile->first()->slug === 'COP')
                                                        <li>
                                                            <a href="{{ route($product->code . '.fa.edit', [
                                                                'rp_id' => encode($product->rp->id),
                                                                'id'    => encode($record->id)
                                                            ]) }}" ng-click="process($event)">
                                                                <i class="icon-plus2"></i> Procesar
                                                            </a>
                                                        </li>
                                                    @endif

                                                    @if ($record->company_state === 'O' || $record->company_state === 'C')
                                                        <li>
                                                            @if ($record->observations->last()->state->slug === 'me')
                                                                <a href="{{ route('de.fa.mc.show', [
                                                                    'rp_id' => encode($product->rp->id),
                                                                    'id'    => encode($record->id)
                                                                ]) }}" target="_blank">
                                                                    <i class="icon-plus2"></i> Observación
                                                                    ({{ $record->observations->last()->state->state }})
                                                                </a>
                                                            @else
                                                                <a href="{{ route($product->code . '.fa.observation', [
                                                                    'rp_id' => encode($product->rp->id),
                                                                    'id'    => encode($record->id)
                                                                ]) }}" ng-click="observation($event)">
                                                                    <i class="icon-plus2"></i> Observación
                                                                    ({{ $record->observations->last()->state->state }})
                                                                </a>
                                                            @endif
                                                        </li>

                                                        @if ($user->profile->first()->slug === 'SEP'
                                                                && $record->company_state === 'O'
                                                                && $record->observations->last()->state->slug === 'cl'
                                                                && ! $record->observations->last()->response)
                                                            <li>
                                                                <a href="{{ route($product->code . '.fa.create.answer', [
                                                                    'rp_id'          => encode($product->rp->id),
                                                                    'id'             => encode($record->id),
                                                                    'id_observation' => encode($record->observations->last()->id)
                                                                ]) }}" ng-click="observation($event)">
                                                                    <i class="icon-plus2"></i> Responder
                                                                </a>
                                                            </li>
                                                        @endif

                                                        @if ($user->profile->first()->slug === 'SEP' && $record->observations->last()->state->slug === 'de')
                                                            <li>
                                                                <a href="{{ route($product->code . '.edit', [
                                                                    'rp_id'     => encode($product->rp->id),
                                                                    'header_id' => encode($record->detail->header->id),
                                                                    'idf'       => encode($record->id)
                                                                ]) }}">
                                                                    <i class="icon-plus2"></i> Editar Póliza
                                                                </a>
                                                            </li>
                                                        @endif

                                                    @endif

                                                    @if ($record->company_state === 'C' && $record->observations->last()->response)
                                                        <li>
                                                            <a href="{{ route($product->code . '.fa.response', [
                                                                'rp_id'          => encode($product->rp->id),
                                                                'id'             => encode($record->id),
                                                                'id_observation' => encode($record->observations->last()->id)
                                                            ]) }}" ng-click="observation($event)">
                                                                <i class="icon-plus2"></i> Respuesta
                                                                ({{ $record->observations->last()->state->state }})
                                                            </a>
                                                        </li>
                                                    @endif

                                                        <li>
                                                            <a href="{{route('create_modal_slip', ['id_retailer_product'=>encode($product->rp->id), 'id_au_header'=>encode($record->detail->header->id), 'text'=>'issuance', 'type'=>'IMPR'])}}"
                                                               id="issuance" class="open_modal">
                                                                <i class="icon-plus2"></i> Ver Certificado de Emision
                                                            </a>
                                                        </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>

            <input type="hidden" id="read-edit"
                   value="{{ route('de.fa.read.update', ['rp_id' => ':rp_id', 'id' => ':id']) }}">
        </div>
    </aside>
</div>

@if(session('success_header'))
    <script>
        $(function () {
            messageAction('succes', "{{ session('success_header') }}");
        });
    </script>
@endif

@include('partials.modal_content')