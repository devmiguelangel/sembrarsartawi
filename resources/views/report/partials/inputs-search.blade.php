{{ csrf_field() }}

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