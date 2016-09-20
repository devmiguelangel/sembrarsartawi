<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    {!! Html::style('assets/css/bootstrap.css') !!}

</head>
<body style="background: #FFF; font-size: 10px;">

<div class="container" style="width: 700px;">
    <img src="{{ asset($fa->observations->last()->user->retailerUser->company->image) }}"
         style="margin-top: -10px; margin-left: 10px; position: fixed;" width="110">

    <h5 style="margin-bottom: 0px; display: block; text-align: right;">{!! $mc->name  !!}</h5>
    <h5 style="margin-top: 0px; display: block; text-align: right;">
        <strong>Orden de Atención Medica Nº {{ $answer->medical_certificate_number }}</strong>
    </h5>

    <div>
        <table class="table table-condensed">
            <tbody>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
            </tr>
            <tr>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                    <strong>Paciente:</strong>
                </td>
                <td colspan="3" style="padding-top: 2px; padding-bottom: 2px;">
                    {{ $fa->detail->client->full_name }}
                </td>
            </tr>
            <tr>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                    <strong>Carnet de Identidad:</strong>
                </td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $fa->detail->client->dni }} {{ $fa->detail->client->extension }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                    <strong>Dirección</strong>
                </td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $fa->detail->client->home_address }}</td>
            </tr>
            <tr>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                    <strong>Teléfono</strong>
                </td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $fa->detail->client->phone_number_home }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                    <strong>Regional</strong>
                </td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $fa->detail->header->user->city->name }}</td>
            </tr>
            <tr>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                    <strong>Centro de Atención:</strong>
                </td>
                <td colspan="3" style="padding-top: 2px; padding-bottom: 2px;">
                    {{ $answer->center_attention }}
                </td>
            </tr>
            <tr>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                    <strong>Persona de Contacto:</strong>
                </td>
                <td colspan="3" style="padding-top: 2px; padding-bottom: 2px;">
                    {{ $answer->contact_person }}
                </td>
            </tr>
            </tbody>
        </table>

        <div class="label label-default" style="font-size: 11px; color: black; background-color: white;">
            TIPO DE EXAMEN A REALIZAR: *
        </div>

        @foreach ($mc->certificateQuestionnaires as $cq => $certificateQuestionnaire)
            <h6 style="margin-top: 0px;">
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
                                @var $check = 'X';
                                @var $response = true;
                            @endif
                        @endif
                    @endif

                    <div class="table-bordered" style="padding: 1px 0;">
                        <table>
                            <tr>
                                <td style="width:12px; border: 2px solid #000; padding: 2px;">
                                    <div style="width: 100%; height: 10px; padding-top: -12px; font-size: 14px; font-weight: bold;">{{ $check }}</div>
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

    <p style="text-align: right;">
        {{ $answer->user->city->name }}, {{ $answer->creation_date }}
    </p>

    <div class="fa-align-right">
        <img src="{{ asset('images/firma-mc.png') }}" style="width: 150px; margin-left: 250px;">
    </div>
</div>

</body>
</html>