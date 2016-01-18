<h3>Poliza No. {{ $data['fa']->detail->header->prefix }}-{{ $data['fa']->detail->header->issue_number }}</h3>

<div class="table-responsive">
  <table class="table table-striped table-condensed">
    <tbody>
      <tr class="success">
        <td>ESTADO DE LA SOLICITUD</td>
      </tr>
      <tr>
        <td>
          OBSERVADO ({{ $data['fa']->observations->last()->state->state }})
        </td>
      </tr>
      <tr class="success">
        <td>DETALLES:</td>
      </tr>
      <tr>
        <td>
          {{ $data['fa']->observations->last()->observation }}
        </td>
      </tr>
      <tr class="success">
        <td>RESPUESTA DEL OFICIAL DE CRÉDITO:</td>
      </tr>
      <tr>
        <td>
          {{ $data['fa']->observations->last()->observation_response }}
        </td>
      </tr>
      <tr class="success">
        <td>TITULAR:</td>
      </tr>
      <tr>
        <td>
          {{ $data['fa']->detail->client->full_name }}
        </td>
      </tr>
    </tbody>
  </table>
</div>