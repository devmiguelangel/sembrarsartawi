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
                @if ($data['fa']->observations->last()->state->slug === 'me')
                    <a href="{{ route('de.fa.mc.show', [
                      'rp_id' => encode($data['rp_id']),
                      'id'    => encode($data['fa']->id)
                    ]) }}" class="btn btn-info">Certificado Medico</a>
                @else
                    <strong>{{ $data['fa']->observations->last()->observation }}</strong>
                @endif
            </td>
        </tr>
        <tr class="info">
            <td>
                <strong>CLIENTE:</strong>
            </td>
        </tr>
        <tr>
            <td>
                <strong>{{ $data['client']->full_name }}</strong>
            </td>
        </tr>
        {{--<tr class="info">
            <td>
                <strong>VEHICULO:</strong>
            </td>
        </tr>
        <tr>
            <td>
                <strong>{{ $data['fa']->detail->vehicleType->vehicle }}</strong>
                <br>
                Placa: <strong>{{ $data['fa']->detail->license_plate }}</strong>
            </td>
        </tr>--}}
        </tbody>
    </table>
</div>