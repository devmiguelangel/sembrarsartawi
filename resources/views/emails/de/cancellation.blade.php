<h3>Poliza No. {{ $data['header']->prefix }}-{{ $data['header']->issue_number }}</h3>

<div class="table-responsive">
    <table class="table table-striped table-condensed">
        <tbody>
        <tr class="info">
            <td>
                <strong>ANULACION</strong>
            </td>
        </tr>
        <tr>
            <td>
                <strong>
                    Anulacion de Poliza No. {{ $data['header']->prefix }}-{{ $data['header']->issue_number }}
                    <br><br>
                    Oficial de Credito: {{ $data['header']->user->full_name }}
                    <br><br>
                    Departamento/Regional: {{ is_null($data['header']->user->city) ? 'NINGUNA' : $data['header']->user->city->name }}
                    <br><br>
                    Agencia: {{ is_null($data['header']->user->agency) ? 'NINGUNA' : $data['header']->user->agency->name }}
                    <br><br><br>
                </strong>
            </td>
        </tr>
        <tr class="info">
            <td>
                <strong>Motivo de Anulacion:</strong>
            </td>
        </tr>
        <tr>
            <td>
                <strong>
                    {{ $data['header']->cancellation->reason }}
                </strong>
            </td>
        </tr>
        </tbody>
    </table>
</div>