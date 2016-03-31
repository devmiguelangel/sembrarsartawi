<div class="row">
    <div class="col-md-12">
        <!-- Horizontal form -->
        <div class="panel panel-flat border-top-primary">
            <div class="panel-heading divhr">
                <h6 class="form-wizard-title2 text-semibold">
                    <span class="col-md-11">
                        <span class="form-wizard-count">2</span>
                        Datos del Vehículo
                        <small class="display-block">Cliente</small>
                    </span>
                </h6>
            </div>

            {!! Form::open(['route' => ['au.vh.store', 'rp_id' => $rp_id, 'header_id' => $header_id],
                'method'        => 'post',
                'class'         => 'form-horizontal',
                'ng-controller' => 'DetailAuController',
                'ng-submit'     => 'store($event)',
            ]) !!}

            <div class="panel-body ">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label class="col-lg-9 control-label label_required">Tipo de Vehículo: </label>
                        <div class="col-lg-12 form-group">
                            <select ng-options="t.vehicle for t in data.types track by t.id"
                                    ng-model="formData.vehicle_type" class="form-control">
                            </select>
                            <label id="location-error" class="validation-error-label" for="location"
                                   ng-show="errors['vehicle_type.id']">
                                @{{ errors['vehicle_type.id'][0] }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-9 control-label label_required">Categoria: </label>
                        <div class="col-lg-12">
                            <select ng-options="c.category_name for c in data.categories track by c.id"
                                    ng-model="formData.category" class="form-control" id="category">
                            </select>
                            <label id="location-error" class="validation-error-label" for="location"
                                   ng-show="errors['category.category']">
                                @{{ errors['category.category'][0] }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-9 control-label label_required">Marca: </label>
                        <div class="col-lg-12">
                            <select ng-options="m.make for m in data.makes track by m.id"
                                    ng-model="formData.vehicle_make" class="select-search">
                            </select>
                            <label id="location-error" class="validation-error-label" for="location"
                                   ng-show="errors['vehicle_make.id']">
                                @{{ errors['vehicle_make.id'][0] }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-9 control-label label_required">Modelo: </label>
                        <div class="col-lg-12">
                            <select ng-options="m.model for m in formData.vehicle_make.models track by m.id"
                                    ng-model="formData.vehicle_model" class="select-search">
                            </select>
                            <label id="location-error" class="validation-error-label" for="location"
                                   ng-show="errors['vehicle_model.id']">
                                @{{ errors['vehicle_model.id'][0] }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label label_required">Año: </label>
                        <div class="col-lg-9">
                            <select name="year" class="select-search" ng-model="formData.year">
                                <option value="">Seleccione</option>
                                @for($i = date('Y'); $i >= date('Y') - $parameter->old_car; $i-- )
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <label id="location-error" class="validation-error-label" for="location"
                                   ng-show="errors.year">
                                @{{ errors.year[0] }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <span class="input-group-addon">Placa.</span>
                                {!! Form::text('license_plate', old('license_plate'), [
                                    'class'        => 'form-control ui-wizard-content',
                                    'placeholder'  => 'Nº',
                                    'autocomplete' => 'off',
                                    'ng-model'     => 'formData.license_plate',
                                ]) !!}
                            </div>
                            <label id="location-error" class="validation-error-label" for="location"
                                   ng-show="errors.license_plate">
                                @{{ errors.license_plate[0] }}
                            </label>
                        </div>
                    </div>
                    <div class="alert alert-danger no-border">
                        <span class="text-semibold">Nota.</span> En caso de que la placa este en tramite esciba
                        <a href="#" class="alert-link">ET</a>.
                    </div>
                    <div class="form-group">
                        <label class="col-lg-9 control-label label_required">Uso de Vehículo: </label>
                        <div class="col-lg-12">
                            {!! SelectField::input('use', $data['vehicle_uses']->toArray(), [
                                'class'    => 'form-control',
                                'ng-model' => 'formData.use',
                            ],
                                old('use')) !!}
                            <label id="location-error" class="validation-error-label" for="location"
                                   ng-show="errors.use">
                                @{{ errors.use[0] }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-9 control-label label_required">Cero Kilómetros: </label>
                        <div class="col-lg-12">
                            <select name="mileage" class="form-control" ng-model="formData.mileage">
                                <option value="">Seleccione</option>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                            <label id="location-error" class="validation-error-label" for="location"
                                   ng-show="errors.mileage">
                                @{{ errors.mileage[0] }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-9 label_required">Valor Comercial
                            ({{ $header->currency }}): </label>
                        <div class="col-lg-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class=" icon-coin-dollar"></i></span>
                                {!! Form::text('insured_value', old('insured_value'), [
                                    'class'        => 'form-control',
                                    'autocomplete' => 'off',
                                    'placeholder'  => '(' . $header->currency . ')',
                                    'ng-model'     => 'formData.insured_value',
                                ]) !!}
                            </div>
                            <label id="location-error" class="validation-error-label" for="location"
                                   ng-show="errors.insured_value">
                                @{{ errors.insured_value[0] }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <script ng-if="success.vehicle">
                        $(function () {
                            messageAction('succes', 'El vehículo fue registrado correctamente');
                        });
                    </script>

                    <button type="button" class="btn border-slate text-slate-800 btn-flat" data-dismiss="modal">
                        Cancelar
                    </button>

                    {!! Form::button('Registrar <i class="icon-plus22 position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}

        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".select-search").select2({
                    dropdownParent: "#popup"
                });
            });
        </script>
        <!-- /horizotal form -->
    </div>
</div>