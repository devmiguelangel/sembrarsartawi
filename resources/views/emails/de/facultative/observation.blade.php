<h3>Poliza No. {{ $data['fa']->detail->header->prefix }}-{{ $data['fa']->detail->header->issue_number }}</h3>

<div class="table-responsive">
  <table class="table table-striped table-condensed">
    <tbody>
      <tr class="info">
        <td>ESTADO DE LA SOLICITUD</td>
      </tr>
      <tr>
        <td>
          OBSERVADO ({{ $data['fa']->observations->last()->state->state }})
        </td>
      </tr>
      <tr class="info">
        <td>DETALLES:</td>
      </tr>
      <tr>
        <td>
          {{ $data['fa']->observations->last()->observation }}
        </td>
      </tr>
      <tr class="info">
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