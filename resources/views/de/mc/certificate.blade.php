<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>

  {!! Html::style('assets/css/bootstrap.css') !!}

</head>
<body style="background: #FFF; font-size: 10px;">
  
  <div class="container" style="width: 700px;">
    <h5>{{ $mc->name }}</h5>
    
    <div>
      <table class="table table-condensed">
          <tbody>
            <tr>
              <td style="border: none;"></td>
              <td style="border: none;"></td>
              <td style="border: none;"></td>
            </tr>
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
          <span>{{ $cq + 1 }}</span>
          <small>{{ $certificateQuestionnaire->questionnaire->title }}</small>
        </h6>

        <div class="row">
          @foreach ($certificateQuestionnaire->questions as $question)
            @var $check = '';
            @var $response = false;

            @if (array_key_exists($certificateQuestionnaire->questionnaire->id, $answer->response))
              @if (array_key_exists($question->id, $answer->response[$certificateQuestionnaire->questionnaire->id]))
                @if ($answer->response[$certificateQuestionnaire->questionnaire->id][$question->id]['response'] === 'true')
                  @var $check = 'background: #999;';
                  @var $response = true;
                @endif
              @endif
            @endif

            <div class="table-bordered" style="padding: 1px 0;">
              <table>
                <tr>
                  <td style="width:12px; border: 2px solid #000; padding: 2px;">
                    <div style="width: 100%; height: 10px; {{ $check }}"></div>
                  </td>
                  <td style="padding-left: 5px;">
                    <strong>{{ $question->question }}</strong>
                  </td>
                </tr>
              </table>
              @if ($response && $question->type === 'TX')
                <table>
                  <tr>
                    <td>
                      {{ $answer->response[$certificateQuestionnaire->questionnaire->id][$question->id]['text'] }}
                    </td>
                  </tr>
                </table>
              @endif
            </div>

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