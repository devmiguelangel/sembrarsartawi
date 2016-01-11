<div class="row">
    <div class="col-md-12">
        <!-- Horizontal form -->
        <div class="panel panel-flat border-top-primary">
            <div class="panel-heading divhr">
                <h6 class="form-wizard-title2 text-semibold">
                    <span class="col-md-11">
                        Formulario para aprobar la solicitud no emitida
                        <small class="display-block">Titular {{ $fa->detail->client->full_name }}</small>
                    </span>
                </h6>
            </div>
            <br>

            {!! Form::open(['route' => ['de.fa.update', 'id' => encode($fa->id)], 
                'method'        => 'put', 
                'class'         => 'form-horizontal' ]) !!}

                <div class="form-group">
                    <label class="control-label col-lg-3 label_required">Aprobado: </label>
                    <div class="col-lg-9">
                        <label class="radio-inline">
                            <input type="radio" name="approved" value="1" ng-click="approved = true; state = false;">
                            SI
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="approved" value="0" checked="" ng-click="approved = false; state = false;">
                            NO
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="approved" value="2" ng-click="approved = false; state = true;">
                            Pendiente
                        </label>
                    </div>
                </div>
                
                <div class="animated" ng-show="approved" ng-class="{ fadeIn: approved, fadeOut: !approved }">
                    <div class="form-group">
                        <label class="control-label col-lg-3 label_required">Tasa de Racargo: </label>
                        <div class="col-lg-9">
                            <label class="radio-inline">
                                <input type="radio" name="surcharge" value="1" ng-click="surcharge=true;">
                                SI
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="surcharge" value="0" checked="" ng-click="surcharge=false;">
                                NO
                            </label>
                        </div>
                    </div>

                    <div class="animated" ng-show="surcharge" ng-class="{ fadeIn: surcharge, fadeOut: !surcharge }">
                        <div class="form-group">
                            <label class="control-label col-lg-3 label_required">Porcentaje de Recargo: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                                    {!! Form::text('percentage', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Porcentaje de Recargo',
                                        'autocomplete' => 'off' ])
                                    !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3 label_required">Tasa Actual: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                                    {!! Form::text('current_rate', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Tasa Actual',
                                        'autocomplete' => 'off' ])
                                    !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3 label_required">Tasa Final: </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                                {!! Form::text('final_rate', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Tasa Final',
                                    'autocomplete' => 'off' ])
                                !!}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="animated" ng-show="state" ng-class="{ fadeIn: state, fadeOut: !state }">
                    <div class="form-group">
                        <label class="col-lg-3 control-label label_required">Estado: </label>
                        <div class="col-lg-9">
                            {!! SelectField::input('state', $data['states']->toArray(), [
                                'class' => 'form-control' ]) 
                            !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3 label_required">Observaciones: </label>
                    <div class="col-lg-9">
                        {!! Form::textarea('observation', null, [
                            'size' => '4x4',
                            'class' => 'form-control',
                            'placeholder' => 'Observaciones',
                            'autocomplete' => 'off'])
                        !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-12 label_required">Envie la aprobación vía correo electrónico: </label>
                    <br>
                    <div class="col-lg-12">
                        {!! Form::email('email', $fa->detail->header->user->email, [
                            'class' => 'form-control ui-wizard-content',
                            'placeholder' => 'mail@email.com',
                            'autocomplete' => 'off'])
                        !!}
                    </div>
                </div>

                <div class="text-right">
                    <button type="button" class="btn border-slate text-slate-800 btn-flat" data-dismiss="modal">Cancelar</button>

                    {!! Form::button('Guardar <i class="icon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>

        <!-- /horizotal form -->
    </div>
</div>