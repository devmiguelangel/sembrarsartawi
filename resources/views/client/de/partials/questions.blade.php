<div class="row">
    <div class="col-md-12">
        @foreach($data['questions'] as $question)
            <div class="form-group">
                <div class="col-xs-12 col-md-10">
                    <label class="radio-inline text-semibold">
                        <strong>{{ $question['order'] }}</strong>.
                        {{ $question['question'] }}
                    </label>
                </div>
                <div class="col-xs-12 col-md-2">
                    {!! Form::hidden('qs[' . $question['order'] . '][id]', $question['id']) !!}
                    {!! Form::hidden('qs[' . $question['order'] . '][question]', $question['question']) !!}
                    {!! Form::hidden('qs[' . $question['order'] . '][expected]', $question['expected']) !!}
                    {!! Form::hidden('qs[' . $question['order'] . '][type]', $question['type']) !!}
                    {!! Form::hidden('qs[' . $question['order'] . '][response_text]', (int) $question['response_text']) !!}

                    <label class="radio-inline radio-right">
                        {!! Form::radio('qs[' . $question['order'] . '][response]', '1', ($action === 'CREATE' ? '' : $question['check_yes']), ['class' => 'styled']) !!}
                        Si
                    </label>
                    <label class="radio-inline radio-right">
                        {!! Form::radio('qs[' . $question['order'] . '][response]', '0', ($action === 'CREATE' ? '' : $question['check_no']), ['class' => 'styled']) !!}
                        No
                    </label>
                </div>
            </div>

            <div class="form-group" align="center">
                @if($question['type'] === 'PMO' && $question['response_text'])
                    <input type="text" class="form-control" autocomplete="off"
                           name="{{ 'qs[' . $question['order'] . '][response_specification]' }}"
                           style="width: 70%; border: none; border-bottom: 1px dashed #000000;"
                           placeholder="En caso que la respuesta sea afirmativa, favor especificar"
                           value="{{ old('qs.' . $question['order'] . '.response_specification', $question['response_specification']) }}">
                    @if ($errors->first('qs.' . $question['order'] . '.response_specification'))
                        <span class="validation-error-label" for="location">Especificación requerida.</span>
                    @endif
                @elseif($data['vg'])
                    <table class="table-condensed">
                        <tr>
                            <td>
                                <input type="text"
                                       name="{{ 'qs[' . $question['order'] . '][observations][treatment]' }}"
                                       value="{{ old('qs.' . $question['order'] . '.observations.treatment', $question['observations']['treatment']) }}"
                                       class="form-control" autocomplete="off"
                                       placeholder="Enfermedad parecida o tratamiento recomendado">
                            </td>
                            <td>
                                <input type="text" name="{{ 'qs[' . $question['order'] . '][observations][date]' }}"
                                       value="{{ old('qs.' . $question['order'] . '.observations.date', $question['observations']['date']) }}"
                                       class="form-control pickadate-cobodate" autocomplete="off"
                                       placeholder="Fecha">
                            </td>
                            <td>
                                <input type="text" name="{{ 'qs[' . $question['order'] . '][observations][duration]' }}"
                                       value="{{ old('qs.' . $question['order'] . '.observations.duration', $question['observations']['duration']) }}"
                                       class="form-control" autocomplete="off" placeholder="Duración">
                            </td>
                            <td>
                                <input type="text" name="{{ 'qs[' . $question['order'] . '][observations][clinic]' }}"
                                       value="{{ old('qs.' . $question['order'] . '.observations.clinic', $question['observations']['clinic']) }}"
                                       class="form-control" autocomplete="off"
                                       placeholder="Nombre de la clínica o del médico tratante">
                            </td>
                            <td>
                                <input type="text" name="{{ 'qs[' . $question['order'] . '][observations][state]' }}"
                                       value="{{ old('qs.' . $question['order'] . '.observations.state', $question['observations']['state']) }}"
                                       class="form-control" autocomplete="off" placeholder="Estado Actual">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                @if ($errors->first('qs.' . $question['order'] . '.response_observation'))
                                    <span class="validation-error-label" for="location">
                                        Por favor sirvase en brindar detalles (Todos los campos son obligatorios).
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </table>
                @endif
            </div>
        @endforeach
    </div>
</div>

<label id="location-error" class="validation-error-label"
       for="location">{{ $errors->first('responses') }}</label>

<hr>
<div class="form-group">
    @if($data['detail']->header->creditProduct->slug !== 'PMO' && ! $data['vg'])
        {!! Form::textarea('qs_observation', old('desc_occupation', $data['observation']), [
            'size'         => '4x4',
            'class'        => 'form-control',
            'placeholder'  => 'Observación',
            'autocomplete' => 'off',
        ]) !!}

        <label id="location-error" class="validation-error-label"
               for="location">{{ $errors->first('qs_observation') }}</label>
    @elseif($data['vg'])
        {!! Form::hidden('vg', md5(1)) !!}
    @else
        {!! Form::hidden('credit_product', md5(1)) !!}
    @endif

    {!! Form::hidden('qs_number', count($data['questions'])) !!}
</div>