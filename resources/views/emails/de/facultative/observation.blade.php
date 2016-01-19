<h3>Poliza No. {{ $data['fa']->detail->header->prefix }}-{{ $data['fa']->detail->header->issue_number }}</h3>

<div class="table-responsive">
  <table class="table table-striped table-condensed">
    <tbody>
      <tr class="info">
        <td>
          <strong>ESTADO DE LA SOLICITUD</strong>
        </td>
      </tr>
      <tr>
        <td>
          <strong>OBSERVADO ({{ $data['fa']->observations->last()->state->state }})</strong>
        </td>
      </tr>
      <tr class="info">
        <td>
          <strong>DETALLES:</strong>
        </td>
      </tr>
      <tr>
        <td>
          <strong>{{ $data['fa']->observations->last()->observation }}</strong>
        </td>
      </tr>
      <tr class="info">
        <td>
          <strong>TITULAR:</strong>
        </td>
      </tr>
      <tr>
        <td>
          <strong>{{ $data['fa']->detail->client->full_name }}</strong>
        </td>
      </tr>
    </tbody>
  </table>
</div>