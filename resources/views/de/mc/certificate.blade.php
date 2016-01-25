<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>

  {!! Html::style('assets/css/bootstrap.min.css') !!}

</head>
<body style="background: #FFF; font-size: 10px;">
  
  <div class="container" style="width: 750px;">
    <h5>{{ $mc->name }}</h5>
    
    <div class="form-inline">
      <table class="table table-condensed">
        <tbody>
          <tr>
            <td>
              <strong>Paciente:</strong>
            </td>
            <td colspan="3">
              {{ $fa->detail->client->full_name }}
            </td>
          </tr>
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
              {{ $answer->center_attention }}
            </td>
          </tr>
          <tr>
            <td>
              <strong>Persona de Contacto:</strong>
            </td>
            <td colspan="3">
              {{ $answer->contact_person }}
            </td>
          </tr>
        </tbody>
      </table>

      @foreach ($mc->certificateQuestionnaires as $cq => $certificateQuestionnaire)
        <h6>
          <span class="label label-primary">{{ $cq + 1 }}</span>
          <small>{{ $certificateQuestionnaire->questionnaire->title }}</small>
        </h6>

        <div class="row">
          @foreach ($certificateQuestionnaire->questions as $question)
              @var $check = 'unchecked';
              @var $response = false;

              @if (array_key_exists($certificateQuestionnaire->questionnaire->id, $answer->response))
                @if (array_key_exists($question->id, $answer->response[$certificateQuestionnaire->questionnaire->id]))
                  @if ($answer->response[$certificateQuestionnaire->questionnaire->id][$question->id]['response'] === 'true')
                    @var $check = 'check';
                    @var $response = true;
                  @endif
                @endif
              @endif

              @if ($question->type === 'CB')
                <div class=" table-bordered">
                  <label class="checkbox-inline">
                    <span class="glyphicon glyphicon-{{ $check }}" aria-hidden="true"></span>

                    {{ $question->question }}
                  </label>
                </div>
              @elseif ($question->type === 'TX')
                <div class=" table-bordered">
                  <label class="checkbox-inline">
                    
                    <span class="glyphicon glyphicon-{{ $check }}" aria-hidden="true"></span>

                    <strong>{{ $question->question }}</strong> - 
                    @if ($response)
                      {{ $answer->response[$certificateQuestionnaire->questionnaire->id][$question->id]['text'] }}
                    @endif
                  </label>
                </div>
              @endif
          @endforeach
        </div>
      @endforeach
    </div>
    <br>
    
    <p>
      Nota: <br>
      *El asegurado deberá mostrar al Médico el Carnet de Identidad antes de ser atendido. <br>
      **Para la toma de muestras de sangre y orina el asegurado deberá encontrarse en ayunas
    </p>
  </div>

</body>
</html>