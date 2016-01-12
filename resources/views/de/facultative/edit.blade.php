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
                'method'    => 'put', 
                'class'     => 'form-horizontal',
                'ng-controller' => 'FacultativeController',
                'ng-submit' => 'store($event)' ]) !!}

                <div class="form-group">
                    <label class="control-label col-lg-3 label_required">Aprobado: </label>
                    <div class="col-lg-9">
                        <div class="input-group">
                            <label class="radio-inline">
                                {!! Form::radio('approved', 'aaa', false, [
                                    'ng-click' => 'approved = true; state = false;', 
                                    'ng-model' => 'formData.approved'
                                ]) !!}
                                SI
                            </label>
                            <label class="radio-inline">
                                {!! Form::radio('approved', 0, false, [
                                    'ng-click' => 'approved = false; state = false;', 
                                    'ng-model' => 'formData.approved'
                                ]) !!}
                                NO
                            </label>
                            <label class="radio-inline">
                                {!! Form::radio('approved', 2, false, [
                                    'ng-click' => 'approved = false; state = true;', 
                                    'ng-model' => 'formData.approved'
                                ]) !!}
                                Pendiente
                            </label>
                        </div>
                        <label id="location-error" class="validation-error-label" for="location" ng-show="errors.approved">
                            @{{ errors.approved[0] }}
                        </label>
                    </div>
                </div>
                
                <div class="animated" ng-show="approved" ng-class="{ fadeIn: approved, fadeOut: !approved }">
                    <div class="form-group">
                        <label class="control-label col-lg-3 label_required">Tasa de Racargo: </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <label class="radio-inline">
                                    {!! Form::radio('surcharge', 1, false, [
                                        'ng-click' => 'surcharge=true;', 
                                        'ng-model' => 'formData.surcharge'
                                    ]) !!}
                                    SI
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('surcharge', 0, false, [
                                        'ng-click' => 'surcharge=false;', 
                                        'ng-model' => 'formData.surcharge'
                                    ]) !!}
                                    NO
                                </label>
                            </div>
                            <label id="location-error" class="validation-error-label" for="location" ng-show="errors.surcharge">
                                @{{ errors.surcharge[0] }}
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
                                        'class'        => 'form-control',
                                        'placeholder'  => 'Porcentaje de Recargo',
                                        'autocomplete' => 'off', 
                                        'ng-model'     => 'formData.percentage'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label" for="location" ng-show="errors.percentage">
                                    @{{ errors.percentage[0] }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3 label_required">Tasa Actual: </label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                                    {!! Form::text('current_rate', null, [
                                        'class'        => 'form-control',
                                        'placeholder'  => 'Tasa Actual',
                                        'autocomplete' => 'off',
                                        'ng-model'     => 'formData.current_rate',
                                        'ng-init'      => 'formData.current_rate = "0.88"'
                                    ]) !!}
                                </div>
                                <label id="location-error" class="validation-error-label" for="location" ng-show="errors.current_rate">
                                    @{{ errors.current_rate[0] }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3 label_required">Tasa Final: </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                                {!! Form::text('final_rate', null, [
                                    'class'        => 'form-control',
                                    'placeholder'  => 'Tasa Final',
                                    'autocomplete' => 'off',
                                    'ng-model'     => 'formData.final_rate',
                                     'ng-init'     => 'formData.final_rate = formData.current_rate + formData.percentage'
                                ]) !!}
                            </div>
                            <label id="location-error" class="validation-error-label" for="location" ng-show="errors.final_rate">
                                @{{ errors.final_rate[0] }}
                            </label>
                        </div>
                    </div>

                </div>

                <div class="animated" ng-show="state" ng-class="{ fadeIn: state, fadeOut: !state }">
                    <div class="form-group">
                        <label class="col-lg-3 control-label label_required">Estado: </label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                {!! SelectField::input('state', $data['states']->toArray(), [
                                    'class'    => 'form-control',
                                    'ng-model' => 'formData.state'
                                ]) !!}
                            </div>
                            <label id="location-error" class="validation-error-label" for="location" ng-show="errors.state">
                                @{{ errors.state[0] }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3 label_required">Observaciones: </label>
                    <div class="col-lg-9">
                        <div>
                            {!! Form::textarea('observation', null, [
                                'size'         => '4x4',
                                'class'        => 'form-control',
                                'placeholder'  => 'Observaciones',
                                'autocomplete' => 'off',
                                'ng-model'     => 'formData.observation'
                            ]) !!}
                        </div>
                        <label id="location-error" class="validation-error-label" for="location" ng-show="errors.observation">
                            @{{ errors.observation[0] }}
                        </label>
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