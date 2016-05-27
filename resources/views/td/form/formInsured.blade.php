{!! Form::open(array('route' => ['td.save.insured','rp_id'=>$rp_id,'header_id'=>encode($header_id)], 'name' => 'Form', 'id' => 'insured_form', 'class'=>'form-horizontal form-validate-jquery')) !!}    
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label class="col-lg-12 control-label label_required">Materia: </label>
            <div class="col-lg-12">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token" >
                <input type="hidden" value="{{ $header_id }}" name="id_header" id="id_header" >
                <input type="hidden" value="{{ $detail->id }}" name="id_detail" id="id_detail" >
                {!! SelectField::input('matter_insured', $materia, [
                    'class' => 'select2-choice col-xs-12 col-lg-12',
                    'required' => 'required',
                    'id' => 'matter_insured'],
                    old('matter_insured', $detail->matter_insured))
                !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-12 control-label label_required">Descripción: </label>
            <div class="col-lg-12">
                {!! Form::textarea('matter_description', old('matter_description', $detail->matter_description), [
                    'size'         => '4x4',
                    'class'        => 'form-control',
                    'placeholder'  => 'Descripción',
                    'autocomplete' => 'off',
                    'required' => 'required',
                    'ng-model'     => 'formData.reason',
                    'id'     => 'matter_description']) 
                !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-12 control-label label_required">Número: </label>
            <div class="col-lg-12">
                <div class="input-group">
                    <span class="input-group-addon">Nro</span>
                    {!! Form::text('number', old('number', $detail->number), [
                        'class'        => 'form-control ui-wizard-content',
                        'id' => 'number',
                        'autocomplete' => 'off',
                        'required' => 'required',
                        'placeholder'  => 'Número'])
                    !!}
                </div>
                <small>N° Folio Real o N° Serie Según corresponda</small>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label class="col-lg-12 control-label">Uso: </label>
            <div class="col-lg-12">
                {!! SelectField::input('use', $uso, [
                    'class' => 'select2-choice col-xs-12 col-lg-12', 
                    'id' => 'use'],
                    old('use', $detail->use))
                !!}
            </div>
            <small>Domiciliario / Industrial u Otro </small>
        </div>
        <h6>Valor Asegurado</h6>
        <hr />
        <div class="form-group valor_construccion" style="display: none;">
            <label class="control-label col-lg-12 label_required">Valor Construcción: </label>
            <div class="col-lg-12">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    {!! Form::text('construction_value', old('construction_value', $detail->construction_value), [
                        'class'        => 'form-control ui-wizard-content',
                        'id'        => 'construction_value',
                        'operation_number'        => 'operation_number',
                        'autocomplete' => 'off',
                        'required' => 'required',
                        'placeholder'  => 'Valor Construcción'])
                    !!}
                </div>
            </div>
        </div>
        <div class="form-group valor_de_terreno" style="display: none;">
            <label class="control-label col-lg-12 label_required">Valor de Terreno: </label>
            <div class="col-lg-12">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    {!! Form::text('land_value', old('land_value', $detail->land_value), [
                        'class'        => 'form-control ui-wizard-content',
                        'id'        => 'land_value',
                        'autocomplete' => 'off',
                        'required' => 'required',
                        'placeholder'  => 'Valor de Terreno'])
                    !!}
                </div>
            </div>
        </div>
        <div class="form-group valor_asegurado">
            <label class="control-label col-lg-12 label_required">Valor Asegurado: </label>
            <div class="col-lg-12">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    {!! Form::text('insured_value', old('insured_value', $detail->insured_value), [
                        'class'        => 'form-control ui-wizard-content',
                        'id'        => 'insured_value',
                        'autocomplete' => 'off',
                        'required' => 'required',
                        'placeholder'  => 'Valor Asegurado'])
                    !!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xs-12 col-md-12"></div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label class="col-lg-12 control-label">Departamento: </label>
            <div class="col-lg-12">
                {!! SelectField::input('city', $city, [
                    'class' => 'select2-choice col-xs-12 col-lg-12',
                    'id' => 'city'],
                    old('city', $detail->city))
                !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-12 control-label">Zona: </label>
            <div class="col-lg-12">
                {!! Form::textarea('zone', old('zone',$detail->zone), [
                    'size'         => '4x4',
                    'class'        => 'form-control',
                    'id'        => 'zone',
                    'placeholder'  => 'Zona',
                    'autocomplete' => 'off',
                    'ng-model'     => 'formData.reason'
                ]) !!}
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label class="col-lg-12 control-label label_required">Ciudad o Localidad: </label>
            <div class="col-lg-12">
                {!! Form::text('locality', old('locality', $detail->locality), [
                    'class'        => 'form-control ui-wizard-content',
                    'id'        => 'locality',
                    'autocomplete' => 'off',
                    'required' => 'required',
                    'placeholder'  => 'Ciudad o Localidad'])
                !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-12 control-label">Dirección: </label>
            <div class="col-lg-12">
                {!! Form::textarea('address', old('address', $detail->address), [
                    'size'         => '4x4',
                    'class'        => 'form-control',
                    'id'        => 'address',
                    'placeholder'  => 'Dirección',
                    'autocomplete' => 'off',
                    'ng-model'     => 'formData.reason'
                ]) !!}
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="text-right">
        <button type="submit" class="btn btn-primary">Guardar <i class="glyphicon glyphicon-floppy-disk position-right"></i></button>
        <a style="display:none;" class="list_content" onclick="listInsured('{{ route('td.list.insured',['rp_id'=>$rp_id,'header_id'=>encode($header_id)])}}', 'GET', '{{ $header_id }}');"></a>
    </div>
{!!Form::close()!!}
<script>
$(document).ready(function() { 
    // procesa combo Uso
//    valueUse();
    
    $('#insured_form').on('submit', function(event) {
        event.preventDefault();
        var formData = {
            _token: $('#_token').val(),
            id_header: $('#id_header').val(),
            id_detail: $('#id_detail').val(),
            matter_insured: $('#matter_insured').val(),
            matter_description: $('#matter_description').val(),
            number: $('#number').val(),
            use: $('#use').val(),
            construction_value: $('#construction_value').val(),
            land_value: $('#land_value').val(),
            insured_value: $('#insured_value').val(),
            city: $('#city').val(),
            zone: $('#zone').val(),
            locality: $('#locality').val(),
            address: $('#address').val()
        }
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            success: function(data) {
                $('.list_content').click();
                $('#close_modal').click();
            }
        })
        return false;
    });
});

// valida combo box valor asegurado
$('#matter_insured').change(function(){
    if($('#matter_insured').val() == 'PR'){
        $('.valor_construccion').show();
        $('#construction_value').attr('required','true');
        
        $('.valor_de_terreno').show();
        $('#land_value').attr('required','true');
        
        $('.valor_asegurado').hide();
        $('#insured_value').removeAttr('required');
    }else{
        $('.valor_construccion').hide();
        $('#construction_value').removeAttr('required');
        
        $('.valor_de_terreno').hide();
        $('#land_value').removeAttr('required');
        
        $('.valor_asegurado').show();
        $('#insured_value').attr('required','true');
    }
});

$('#matter_insured').change(function(){
    valueUse();
});

</script>
