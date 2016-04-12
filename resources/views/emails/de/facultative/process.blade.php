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
                <strong>{{ $data['fa']->approved ? 'APROBADO' : 'RECHAZADO' }}</strong>
            </td>
        </tr>
        @if ($data['fa']->approved)
            <tr class="info">
                <td>
                    <strong>TASA DE RECARGO</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>{{ $data['fa']->surcharge ? 'SI' : 'NO' }} - {{ $data['fa']->percentage }} %</strong>
                </td>
            </tr>
            <tr class="info">
                <td>
                    <strong>TASA FINAL</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>{{ $data['fa']->final_rate }}</strong>
                </td>
            </tr>
        @endif
        <tr class="info">
            <td>
                <strong>DETALLES:</strong>
            </td>
        </tr>
        <tr>
            <td>
                <strong>{{ $data['fa']->observation }}</strong>
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
        </tbody>
    </table>
</div>