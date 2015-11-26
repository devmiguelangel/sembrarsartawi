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
                    <label class="radio-inline radio-right">
                        {!! Form::radio('qs[' . $question['order'] . '][response]', '1', $question['check_yes'], ['class' => 'styled']) !!}
                        Si
                    </label>
                    <label class="radio-inline radio-right">
                        {!! Form::radio('qs[' . $question['order'] . '][response]', '0', $question['check_no'], ['class' => 'styled']) !!}
                        No
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>
<hr>
<div class="form-group">
    {!! Form::textarea('qs_observation', old('desc_occupation', $data['observation']), [
        'size' => '4x4',
        'class' => 'form-control',
        'placeholder' => 'Observación',
        'autocomplete' => 'off'])
    !!}
    {!! Form::hidden('qs_number', count($data['questions'])) !!}
</div>