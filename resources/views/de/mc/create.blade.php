<div class="">
  <h4>Formulario de Requisitos de Asegurabilidad Prestatarios SEMBRAR SARTAWI IFD</h4>
    {!! Form::open(['route' => ['de.fa.mc.store', 'rp_id' => $rp_id, 'id' => $id], 
      'method'    => 'post', 
      'class'     => 'form-inline',
      'ng-submit' => 'mcStore($event)' ]) !!}
      
      <h6>{{ $fa->detail->client->full_name }}</h6>

      <table class="table table-condensed">
        <tbody>
          <tr>
            <td>
              <strong>Carnet de Identidad:</strong>
            </td>
            <td>{{ $fa->detail->client->dni }} {{ $fa->detail->client->extension }}</td>
            <td>
              <strong>Dirección</strong>
            </td>
            <td>{{ $fa->detail->client->home_address }}</td>
          </tr>
          <tr>
            <td>
              <strong>Teléfono</strong>
            </td>
            <td>{{ $fa->detail->client->phone_number_home }}</td>
            <td>
              <strong>Regional</strong>
            </td>
            <td></td>
          </tr>
          <tr>
            <td>
              <strong>Centro de Atención:</strong>
            </td>
            <td colspan="3">
              {!! Form::text('center_attention', null, [
                  'class' => 'form-control',
                  'autocomplete' => 'off',
                  'placeholder' => 'Centro de Atención'
              ]) !!}
            </td>
          </tr>
          <tr>
            <td>
              <strong>Persona de Contacto:</strong>
            </td>
            <td colspan="3">
              {!! Form::text('contact_person', null, [
                  'class' => 'form-control',
                  'autocomplete' => 'off',
                  'placeholder' => 'Persona de Contacto'
              ]) !!}
            </td>
          </tr>
        </tbody>
      </table>

      <h5><span class="label label-primary">1</span> Example heading</h5>

      <div class="row">
        <div class="col-md-4 table-bordered">
          <label class="checkbox-inline">
            {!! Form::checkbox('qs-1', 1, false, [
                
            ]) !!}
            Cuestionario medico especifico
          </label>
        </div>
        <div class="col-md-4 table-bordered">
          <label class="checkbox-inline">
            {!! Form::checkbox('qs-1', 1, false, [
                
            ]) !!}
            Cuestionario medico especifico
          </label>
        </div>
        <div class="col-md-4 table-bordered">
          <label class="checkbox-inline">
            {!! Form::checkbox('qs-1', 1, false, [
                
            ]) !!}
            Cuestionario medico especifico
          </label>
        </div>
      </div>
      
      <h5><span class="label label-primary">2</span> Example heading</h5>
      <div class="row">
        <div class="col-md-6 table-bordered">.col-md-6</div>
        <div class="col-md-6 table-bordered">.col-md-6</div>
      </div>

      <h5><span class="label label-primary">3</span> Example heading</h5>
      <div class="row">
        <div class="col-md-12 form-group table-bordered">
          <label class="checkbox-inline">
            {!! Form::checkbox('qs-1', 1, false, [
                
            ]) !!}
            Otros
          </label>
          {!! Form::text('observation', null, [
              'class'        => 'form-control',
              'autocomplete' => 'off',
              'placeholder'  => 'Observaciones',
              'size'         => '75'
          ]) !!}
        </div>
      </div>

      <br>
      
      <div class="text-right">
          {{-- <script ng-if="success.facultative">
              $(function(){messageAction('succes', 'El caso facultativo se proceso correctamente');});
          </script> --}}

          <button type="button" class="btn border-slate text-slate-800 btn-flat" ng-click="mcEnabled = false;">Cancelar</button>

          {!! Form::button('Guardar <i class="icon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
      </div>

    {!! Form::close() !!}
</div>