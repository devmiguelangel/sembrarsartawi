<div class="row">
    <div class="col-md-12">
        <!-- Horizontal form -->
        <div class="panel panel-flat border-top-primary">
            <div class="panel-heading divhr">
                <h6 class="form-wizard-title2 text-semibold">
                    <span class="col-md-11">
                        <span class="form-wizard-count">4</span>
                        Datos del Saldo deudor
                        <small class="display-block">Titular {{ $detail->client->full_name }}</small>
                    </span>
                </h6>
            </div>

            @if(session('error_detail'))
                <div class="alert bg-danger alert-styled-right">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                class="sr-only">Close</span></button>
                    <span class="text-semibold">{{ session('error_detail') }}</span>.
                </div>
            @endif

            <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
                <!--<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>-->
                <h6 class="alert-heading text-semibold">Importante</h6>
                Comprobar y validar saldos para deuda directa titular en créditos paralelos y refinanciados.
            </div>

            {!! Form::open(['route' => ['de.detail.balance.update', 'rp_id' => $rp_id, 'header_id' => encode($header->id), 'detail_id' => encode($detail->id)],
                'method'        => 'put',
                'class'         => 'form-horizontal',
                'ng-controller' => 'DetailDeController as detailDe',
                'ng-submit'     => 'detailDe.updateBalance($event)'
            ]) !!}

            <div class="form-group">
                <label class="control-label col-lg-3"></label>
                <div class="col-lg-9">
                    Tipo de Movimiento:
                    <span class="no-margin text-semibold">{{ config('base.movement_types.' . $header->movement_type) }}</span>
                </div>
                <br>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-3 label_required">Monto Actual Solicitado: </label>
                <div class="col-lg-9">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-cash2"></i></span>
                        {!! Form::text('amount_requested', null, [
                            'class'        => 'form-control',
                            'readonly'     => 'true',
                            'placeholder'  => 'Monto Actual Solicitado',
                            'autocomplete' => 'off',
                            'type'         => 'number',
                            'ng-model'     => 'formData.amount_requested',
                        ]) !!}
                    </div>
                    <label id="location-error" class="validation-error-label" for="location"
                           ng-show="errors.amount_requested">@{{ errors.amount_requested[0] }}</label>
                </div>
            </div>

            <div class="form-group">
                <div class="alert alert-info text-center" style="padding: 10px;"
                     ng-if="formData.movement_type == 'FS' || formData.movement_type == 'AD'">
                    No tomar en cuenta la Solicitud Actual.
                </div>
                <div class="alert alert-danger text-center" style="padding: 10px;"
                     ng-if="formData.movement_type == 'LC'">
                    Llenar solo en caso que el cliente tenga créditos adicionales, FUERA de línea.
                </div>

                <label class="control-label col-lg-3 label_required">Saldo deudor actual del asegurado (Bs.): </label>
                <div class="col-lg-9">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-cash2"></i></span>
                        {!! Form::text('balance', null, [
                            'class'        => 'form-control',
                            'placeholder'  => 'Saldo deudor actual del asegurado (Bs.)',
                            'autocomplete' => 'off',
                            'type'         => 'number',
                            'ng-model'     => 'formData.balance',
                            'ng-keyup'     => 'cumulus()',
                            $header->movement_type == 'FS' ? 'readonly' : '',
                        ]) !!}
                    </div>
                    <label id="location-error" class="validation-error-label" for="location"
                           ng-show="errors.balance">@{{ errors.balance[0] }}</label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 label_required">Monto Actual Acumulado (Bs.): </label>
                <div class="col-lg-9">
                    <h6 class="text-muted content-group-sm"
                        ng-if="formData.movement_type != 'LC'">@{{ formData.cumulus | currency : 'Bs. ' }} </h6>
                    <div class="input-group" ng-if="formData.movement_type == 'LC'">
                        <span class="input-group-addon"><i class="icon-cash2"></i></span>
                        {!! Form::text('cumulus', null, [
                            'class'        => 'form-control',
                            'placeholder'  => 'Monto Total Acumulado (Bs.)',
                            'autocomplete' => 'off',
                            'type'         => 'number',
                            'ng-model'     => 'formData.cumulus',
                        ]) !!}
                    </div>
                    <div class="alert-warning text-center" style="padding: 5px;" ng-if="data.cumulus">
                        El monto total acumulado debe ser mayor o igual al monto actual solicitado y al saldo deudor
                        actual.
                    </div>
                    <label id="location-error" class="validation-error-label" for="location"
                           ng-show="errors.cumulus">@{{ errors.cumulus[0] }}</label>
                </div>
            </div>

            <div class="text-right">
                <script ng-if="success.beneficiary">
                    $(function () {
                        messageAction('succes', 'El Saldo Deudor fue actualizado correctamente');
                    });
                </script>

                <button type="button" class="btn border-slate text-slate-800 btn-flat" data-dismiss="modal">Cancelar
                </button>

                {!! Form::button('Actualizar <i class="icon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <!-- /horizotal form -->
    </div>
</div>
