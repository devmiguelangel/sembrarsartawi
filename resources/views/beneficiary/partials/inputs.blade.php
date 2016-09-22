<div class="form-group">
    <label class="control-label col-lg-3  label_required">Nombres: </label>
    <div class="col-lg-9">
        <div class="input-group">
            <span class="input-group-addon"><i class="icon-user-plus"></i></span>
            {!! Form::text('first_name', old('first_name'), [
                'class'        => 'form-control',
                'placeholder'  => 'Nombres',
                'autocomplete' => 'off',
                'ng-model'     => 'formData.first_name',
                'ng-init'      => 'formData.type="' . request()->get('type') . '"',
            ]) !!}
        </div>
        <label id="location-error" class="validation-error-label" for="location"
               ng-show="errors.first_name">@{{ errors.first_name[0] }}</label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-3  label_required">Ap. Paterno: </label>
    <div class="col-lg-9">
        <div class="input-group">
            <span class="input-group-addon"><i class="icon-user-plus"></i></span>
            {!! Form::text('last_name', old('last_name'), [
                'class'        => 'form-control',
                'placeholder'  => 'Ap. Paterno',
                'autocomplete' => 'off',
                'ng-model'     => 'formData.last_name'])
            !!}
        </div>
        <label id="location-error" class="validation-error-label" for="location"
               ng-show="errors.last_name">@{{ errors.last_name[0] }}</label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-3 ">Ap. Materno: </label>
    <div class="col-lg-9">
        <div class="input-group">
            <span class="input-group-addon"><i class="icon-user-plus"></i></span>
            {!! Form::text('mother_last_name', old('mother_last_name'), [
                'class'        => 'form-control',
                'placeholder'  => 'Ap. Materno',
                'autocomplete' => 'off',
                'ng-model'     => 'formData.mother_last_name'])
            !!}
        </div>
        <label id="location-error" class="validation-error-label" for="location"
               ng-show="errors.mother_last_name">@{{ errors.mother_last_name[0] }}</label>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-3  label_required">Parentesco: </label>
    <div class="col-lg-9">
        {!! Form::text('relationship', old('relationship'), [
            'class'        => 'form-control',
            'placeholder'  => 'Parentesco',
            'autocomplete' => 'off',
            'ng-model'     => 'formData.relationship'])
        !!}
        <label id="location-error" class="validation-error-label" for="location"
               ng-show="errors.relationship">@{{ errors.relationship[0] }}</label>
    </div>
</div>

@if(request()->get('type') === 'SP')
    <div class="form-group">
        <label class="control-label col-lg-3 label_required">Documento de Identidad: </label>
        <div class="col-lg-9">
            <div class="input-group">
                <span class="input-group-addon">C.I.</span>
                {!! Form::text('dni', old('dni'), [
                    'class'        => 'form-control',
                    'placeholder'  => 'Documento de Identidad',
                    'autocomplete' => 'off',
                    'ng-model'     => 'formData.dni'
                ]) !!}
            </div>
            <label id="location-error" class="validation-error-label" for="location"
                   ng-show="errors.dni">@{{ errors.dni[0] }}</label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label label_required">Extensión: </label>
        <div class="col-lg-9">
            {!! SelectField::input('extension', $data['cities']['CI']->toArray(), [
                'class'    => 'form-control',
                'ng-model' => 'formData.extension'
            ], old('extension')) !!}
            <label id="location-error" class="validation-error-label" for="location"
                   ng-show="errors.extension">@{{ errors.extension[0] }}</label>
        </div>
    </div>
@elseif(request()->get('type') === 'VI' || request()->get('type') === 'CO')
    <div class="form-group">
        <label class="control-label col-lg-3 label_required">Edad: </label>
        <div class="col-lg-9">
            <div class="input-group">
                <span class="input-group-addon">Años.</span>
                {!! Form::text('age', old('age'), [
                    'class'        => 'form-control',
                    'placeholder'  => '',
                    'autocomplete' => 'off',
                    'ng-model'     => 'formData.age'
                ]) !!}
            </div>
            <label id="location-error" class="validation-error-label" for="location"
                   ng-show="errors.age">@{{ errors.age[0] }}</label>
        </div>
    </div>
@endif