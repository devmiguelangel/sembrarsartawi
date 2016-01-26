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
              <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Anulación de Pólizas</span></h4>
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
                
                <button style="float: right;" type="button" class="btn btn-rounded btn-default text-right" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                    <i class="icon-question7"></i> Producto
                </button>
                </div>
                <div class="clearfix"></div>

                @if(session('error_header'))
                    <div class="alert bg-danger alert-styled-right">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">{{ session('error_header') }}</span>.
                    </div>
                @endif
                
                <div class="panel-body">
                    <div class="col-xs-12">
                        {!! Form::open(['route' => ['de.cancel.lists', 'rp_id' => $rp_id], 'method' => 'get', 'class' => 'form-horizontal']) !!}
                          <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                              <label class="control-label col-lg-2">Nro. de Póliza: </label>
                              <div class="col-lg-2">
                                {!! Form::text('policy_number', old('policy_number'), [
                                  'class'        => 'form-control ui-wizard-content',
                                  'placeholder'  => 'Nro. de Póliza',
                                  'autocomplete' => 'off'])
                                !!}
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-lg-1">Sucursal: </label>
                              <div class="col-lg-3">
                                {!! SelectField::input('city', $data['cities']->toArray(), [
                                  'class' => 'select-search', 
                                  'placeholder'  => 'Sucursal',
                                  ], old('city'))
                                !!}
                              </div>

                              <label class="control-label col-lg-1">Agencia: </label>
                              <div class="col-lg-3">
                                {!! SelectField::input('agency', $data['agencies']->toArray(), [
                                  'class' => 'select-search', 
                                  'placeholder'  => 'Agencia',
                                  ], old('agency'))
                                !!}
                              </div>

                              <label class="control-label col-lg-1">Usuario: </label>
                              <div class="col-lg-3">
                                {!! Form::text('username', old('username'), [
                                  'class'        => 'form-control ui-wizard-content',
                                  'placeholder'  => 'Usuario',
                                  'autocomplete' => 'off'])
                                !!}
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-lg-1">Cliente: </label>
                              <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                    {!! Form::text('client', old('client'), [
                                      'class'        => 'form-control ui-wizard-content',
                                      'placeholder'  => 'Cliente',
                                      'autocomplete' => 'off'])
                                    !!}
                                </div>
                              </div>

                              <label class="control-label col-lg-1">C.I.: </label>
                              <div class="col-lg-2">
                                <div class="input-group">
                                  {!! Form::text('dni', old('dni'), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'C.I.',
                                    'autocomplete' => 'off'])
                                  !!}
                                </div>
                              </div>

                              <label class="control-label col-lg-1">Extensión: </label>
                              <div class="col-lg-2">
                                <div class="input-group">
                                  {!! Form::text('extension', old('extension'), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'Extensión',
                                    'autocomplete' => 'off'])
                                  !!}
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-lg-1">Fecha: </label>
                              <div class="col-lg-4">
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                      {!! Form::text('date_begin', old('date_begin'), [
                                        'class'        => 'form-control pickadate-cobodate',
                                        'placeholder'  => 'Fecha desde',
                                        'autocomplete' => 'off'])
                                      !!}
                                  </div>
                              </div>

                              <div class="col-lg-4">
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                      {!! Form::text('date_end', old('date_end'), [
                                        'class'        => 'form-control pickadate-cobodate',
                                        'placeholder'  => 'Fecha hasta',
                                        'autocomplete' => 'off'])
                                      !!}
                                  </div>
                              </div>
                            </div>

                            <div class="text-right">
                                {!! Form::button('Restablecer campos <i class="icon-reset position-right"></i>', ['type' => 'reset', 'class' => 'btn btn-default']) !!}
                                {!! Form::button('Buscar <i class="icon-arrow-right14 position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            </div>
                          </div>
                        {!! Form::close() !!}

                        <table class="table datatable-fixed-left table-striped" width="100%" ng-controller="CancellationController">
                          <thead>
                            <tr>
                              <th>Nro. de Póliza</th>
                              <th>Cliente</th>
                              <th>C.I.</th>
                              <th>Monto Solicitado</th>
                              <th>Moneda</th>
                              <th>Plazo del Crédito</th>
                              <th>Usuario</th>
                              <th>Sucursal / Agencia</th>
                              <th>Certificados Anulados</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($headers as $header)
                              @foreach ($header->details as $detail)
                                <tr>
                                  <td>{{ $header->prefix }}-{{ $header->issue_number }}</td>
                                  <td>{{ $detail->client->full_name }}</td>
                                  <td>{{ $detail->client->dni }} {{ $detail->client->extension }}</td>
                                  <td>{{ number_format($header->amount_requested, '2', '.', ',') }}</td>
                                  <td>{{ config('base.currencies.' . $header->currency) }}</td>
                                  <td>{{ $header->term }} {{ config('base.term_types.' . $header->type_term) }}</td>
                                  <td>{{ $header->user->full_name }}</td>
                                  <td>
                                    {{ ! is_null($header->user->city) ? $header->user->city->name : '' }}
                                    {{ ! is_null($header->user->agency) ? '/ ' . $header->user->agency->name : '' }}
                                  </td>
                                  <td>{{ 'NO' }}</td>
                                  <td>
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{ route('de.cancel.create', ['rp_id' => $rp_id, 'header_id' => encode($header->id)]) }}" 
                                                      ng-click="cancelCreate($event)">
                                                      <i class="icon-cancel-circle2"></i> Anular
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" onclick="cargaModal({{ $header->id }},'{{ Session::token() }}', 'slip', 'POST', 'emision')" data-toggle="modal" data-target="#modal_general">
                                                        <i class="icon-plus2"></i> Ver Certificado de Desgravamen
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                  </td>
                                </tr>
                              @endforeach
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>

@endsection
