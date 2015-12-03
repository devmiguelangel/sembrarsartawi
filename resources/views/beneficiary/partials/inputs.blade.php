<div class="form-group">
    <label class="control-label col-lg-3  label_required">Nombres: </label>
    <div class="col-lg-9">
        <div class="input-group">
            <span class="input-group-addon"><i class="icon-user-plus"></i></span>
            {!! Form::text('first_name', old('first_name', $beneficiary->first_name), [
                'class' => 'form-control',
                'placeholder' => 'Nombres',
                'autocomplete' => 'off'])
            !!}
        </div>
        <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('first_name') }}</label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-3  label_required">Ap. Paterno: </label>
    <div class="col-lg-9">
        <div class="input-group">
            <span class="input-group-addon"><i class="icon-user-plus"></i></span>
            {!! Form::text('last_name', old('last_name', $beneficiary->last_name), [
                'class' => 'form-control',
                'placeholder' => 'Ap. Paterno',
                'autocomplete' => 'off'])
            !!}
        </div>
        <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('last_name') }}</label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-3 ">Ap. Materno: </label>
    <div class="col-lg-9">
        <div class="input-group">
            <span class="input-group-addon"><i class="icon-user-plus"></i></span>
            {!! Form::text('mother_last_name', old('mother_last_name', $beneficiary->mother_last_name), [
                'class' => 'form-control',
                'placeholder' => 'Ap. Materno',
                'autocomplete' => 'off'])
            !!}
        </div>
        <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('mother_last_name') }}</label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-3  label_required">Parentesco: </label>
    <div class="col-lg-9">
        {!! Form::text('relationship', old('relationship', $beneficiary->relationship), [
            'class' => 'form-control',
            'placeholder' => 'Parentesco',
            'autocomplete' => 'off'])
        !!}
        <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('relationship') }}</label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-3 ">Documento de Identidad: </label>
    <div class="col-lg-9">
        <div class="input-group">
            <span class="input-group-addon">C.I.</span>
            {!! Form::text('dni', old('dni', $beneficiary->dni), [
                'class' => 'form-control',
                'placeholder' => 'Documento de Identidad',
                'autocomplete' => 'off'])
            !!}
        </div>
        <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('dni') }}</label>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label">Extensión: </label>
    <div class="col-lg-9">
        {!! SelectField::input('extension', $data['cities']['CI']->toArray(), [
            'class' => 'select-search'],
            old('extension', $beneficiary->extension)) !!}
        <label id="location-error" class="validation-error-label" for="location">{{ $errors->first('extension') }}</label>
    </div>
</div>