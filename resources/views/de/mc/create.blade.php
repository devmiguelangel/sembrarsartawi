<div class="">
  <h4>{{ $mc->name }}</h4>
    {!! Form::open(['route' => ['de.fa.mc.store', 'rp_id' => $rp_id, 'id' => $id],
      'method'    => 'post',
      'class'     => 'form-inline',
      'ng-submit' => 'mcStore($event)' ]) !!}

      <h6>{{ $fa->detail->client->full_name }}</h6>

      <input type="hidden" ng-model="mcData.mcid">

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
              <div class="input-group">
                {!! Form::text('center_attention', null, [
                    'class'        => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder'  => 'Centro de Atención',
                    'size'         => '50',
                    'ng-model'     => 'mcData.center_attention'
                ]) !!}
              </div>
              <label id="location-error" class="validation-error-label" for="location" ng-show="errors.center_attention">
                  @{{ errors.center_attention[0] }}
              </label>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Persona de Contacto:</strong>
            </td>
            <td colspan="3">
              <div class="input-group">
                {!! Form::text('contact_person', null, [
                    'class'        => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder'  => 'Persona de Contacto',
                    'size'         => '50',
                    'ng-model'     => 'mcData.contact_person'
                ]) !!}
              </div>
              <label id="location-error" class="validation-error-label" for="location" ng-show="errors.contact_person">
                  @{{ errors.contact_person[0] }}
              </label>
            </td>
          </tr>
        </tbody>
      </table>

      @foreach ($mc->certificateQuestionnaires as $cq => $certificateQuestionnaire)
        <h6><span class="label label-primary">{{ $cq + 1 }}</span> {{ $certificateQuestionnaire->questionnaire->title }}</h6>

        @var $class = config('base.module_class.' . $certificateQuestionnaire->module);

        <div class="row">
          @foreach ($certificateQuestionnaire->questions as $question)
              @if ($question->type === 'CB')
                <div class="{{ $class }} table-bordered" style="height: 80px;">
                  <label class="checkbox-inline">
                    {!! Form::checkbox('', 1, false, [
                      'ng-model' => 'mcData.answers[' . $certificateQuestionnaire->questionnaire->id . '][' . $question->id . ']["response"]',
                    ]) !!}

                    {{ $question->question }}
                  </label>
                </div>
              @elseif ($question->type === 'TX')
                <div class="col-md-12 table-bordered">
                  <label class="checkbox-inline">
                    {!! Form::checkbox('', 1, false, [
                        'ng-model' => 'mcData.answers[' . $certificateQuestionnaire->questionnaire->id . '][' . $question->id . ']["response"]',
                    ]) !!}

                    {{ $question->question }}
                  </label>
                  {!! Form::text('', null, [
                    'class'        => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder'  => $question->question,
                    'size'         => '75',
                    'ng-model'     => 'mcData.answers[' . $certificateQuestionnaire->questionnaire->id . '][' . $question->id . ']["text"]'
                  ]) !!}
                </div>
              @endif
          @endforeach
        </div>
      @endforeach

      <label id="location-error" class="validation-error-label" for="location" ng-show="errors.answers">
          @{{ errors.answers[0] }}
      </label>

      <br>

      <div class="text-right">
          <script ng-if="success.medical_certificate">
              $(function(){messageAction('succes', 'El Certificado Médico fue registrado correctamente');});
          </script>

          <button type="button" class="btn border-slate text-slate-800 btn-flat" ng-click="mcEnabled = false;">Cancelar</button>

          {!! Form::button('Guardar <i class="icon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
      </div>

    {!! Form::close() !!}
</div>
