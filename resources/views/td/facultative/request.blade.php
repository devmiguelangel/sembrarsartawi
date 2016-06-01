<div class="panel-heading divhr">
    <h6 class="form-wizard-title2 text-semibold">
        <span class="col-md-11">
            <span class="form-wizard-count">4</span>
            Solicitud de aprobación a caso facultativo
        </span>
    </h6>
</div>
<br>

{!! Form::open(array('route' => ['td.fa.request.store','rp_id'=>$rp_id,'header_id' => $header_id], 
    'method'    => 'put',
    'name'      => 'Form', 
    'id'        => 'form_facultative', 
    'class'     => 'form-horizontal form-validate-jquery')) !!}    

{!! Form::textarea('facultative_observation', old('facultative_observation', strip_tags($header->facultative_observation)), [
    'size'         => '4x4',
    'class'        => 'form-control',
    'placeholder'  => 'Observación del Caso Facultativo',
    'autocomplete' => 'off',
    'required' => 'required',
    'ng-model'     => 'formData.reason',
    'id'     => 'facultative_observation']) 
!!}

<div class="text-right">
    <br>
    <script>
    $('#form_facultative').submit(function () {
            messageAction('succes', 'La solicitud fue enviada');
        });    
    
    </script>

    {!! Form::button('Enviar Solicitud <i class="glyphicon glyphicon-send position-right"></i>', [
        'type'  => 'submit',
        'id'  => 'btn_facultative',
        'class' => 'btn btn-primary'
    ]) !!}
</div>

{!! Form::close() !!}
