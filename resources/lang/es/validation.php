<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'alpha'                => 'El campo :attribute sólo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute sólo puede contener letras, números y guiones (a-z, 0-9, -_).',
    'alpha_num'            => 'El campo :attribute sólo puede contener letras y números.',
    'array'                => 'El campo :attribute debe ser un array.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a :date.',
    'between'              => [
        'numeric' => 'El campo :attribute debe ser un valor entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe contener entre :min y :max caracteres.',
        'array'   => 'El campo :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El campo confirmación de :attribute no coincide.',
    'date'                 => 'El campo :attribute no corresponde con una fecha válida.',
    'date_format'          => 'El campo :attribute no corresponde con el formato de fecha :format.',
    'different'            => 'Los campos :attribute y :other han de ser diferentes.',
    'digits'               => 'El campo :attribute debe ser un número de :digits dígitos.',
    'digits_between'       => 'El campo :attribute debe contener entre :min y :max dígitos.',
    'email'                => 'El campo :attribute no corresponde con una dirección de e-mail válida.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'exists'               => 'El campo :attribute no existe.',
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo :attribute debe ser igual a alguno de estos valores :values',
    'integer'              => 'El campo :attribute debe ser un número entero.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida.',
    'json'                 => 'El campo :attribute debe ser una cadena de texto JSON válida.',
    'max'                  => [
        'numeric' => 'El campo :attribute debe ser :max como máximo.',
        'file'    => 'El archivo :attribute debe pesar :max kilobytes como máximo.',
        'string'  => 'El campo :attribute debe contener :max caracteres como máximo.',
        'array'   => 'El campo :attribute debe contener :max elementos como máximo.',
    ],
    'mimes'                => 'El campo :attribute debe ser un archivo de tipo :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe tener al menos :min.',
        'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string'  => 'El campo :attribute debe contener al menos :min caracteres.',
        'array'   => 'El campo :attribute no debe contener más de :min elementos.',
    ],
    'not_in'               => 'El campo :attribute seleccionado es invalido.',
    'numeric'              => 'El campo :attribute debe ser un numero.',
    'regex'                => 'El formato del campo :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio',
    'required_if'          => 'El campo :attribute es obligatorio cuando el campo :other es :value.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ningún campo :values están presentes.',
    'same'                 => 'Los campos :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file'    => 'El archivo :attribute debe pesar :size kilobytes.',
        'string'  => 'El campo :attribute debe contener :size caracteres.',
        'array'   => 'El campo :attribute debe contener :size elementos.',
    ],
    'string'               => 'El campo :attribute debe contener solo caracteres.',
    'timezone'             => 'El campo :attribute debe contener una zona válida.',
    'unique'               => 'El elemento :attribute ya está en uso.',
    'url'                  => 'El formato de :attribute no corresponde con el de una URL válida.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'username'               => 'Nombre de Usuario',
        'password'               => 'Contraseña',
        'email'                  => 'Correo Electrónico',
        'coverage'               => 'Cobertura',
        'amount_requested'       => 'Monto Solicitado',
        'currency'               => 'Moneda',
        'term'                   => 'Plazo',
        'type_term'              => 'Tipo de Plazo',
        'first_name'             => 'Nombre',
        'last_name'              => 'Apellido Paterno',
        'mother_last_name'       => 'Apellido Materno',
        'married_name'           => 'Apellido de Casada',
        'civil_status'           => 'Estado Civil',
        'document_type'          => 'Tipo de Documento',
        'dni'                    => 'Documento de Identidad',
        'complement'             => 'Complemento',
        'extension'              => 'Extensión',
        'country'                => 'País',
        'birthdate'              => 'Fecha de Nacimiento',
        'birth_place'            => 'Lugar de Nacimiento',
        'place_residence'        => 'Lugar de Residencia',
        'locality'               => 'Localidad',
        'home_address'           => 'Dirección',
        'ad_activity_id'         => 'Ocupación',
        'occupation_description' => 'Descripción Ocupación',
        'phone_number_home'      => 'Teléfono',
        'phone_number_mobile'    => 'Teléfono Móvil',
        'phone_number_office'    => 'Teléfono de Oficina',
        'weight'                 => 'Peso',
        'height'                 => 'Estatura',
        'gender'                 => 'Género',
        'hand'                   => 'Mano utilizada',
        'avenue_street'          => 'Avenida o Calle',
        'home_number'            => 'Número de Domicilio',
        'business_address'       => 'Dirección Laboral',
        'qs_observation'         => 'Observación',
        'relationship'           => 'Parentesco',
        'balance'                => 'Saldo deudor',
        'operation_number'       => 'Número de Operación',
        'payment_method'         => 'Forma de Pago',
        'period'                 => 'Periodicidad',
        'account_number'         => 'Número de Cuenta',
        'credit_card'            => 'Tarjeta de Crédito',
        'plan'                   => 'Plan',
        'taker_name'             => 'Nombre del Tomador',
        'taker_dni'              => 'CI/NIT del Tomador',
        'observation'            => 'Observaciones',
        'percentage'             => 'Porcentaje de Recargo',
        'center_attention'       => 'Centro de Atención',
        'contact_person'         => 'Persona de Contacto',
        'answers'                => 'Cuestionario Médico',
        'observation_response'   => 'Respuesta',
        'qs'                     => 'Cuestionario de Salud',
        'numberBN'               => 'Número de Beneficiarios',
        'beneficiaries'          => 'Beneficiarios',
        'insured_value'          => 'Valor Asegurado',
        'warranty'               => 'Garantía',
        'validity_start'         => 'Inicio de Vigencia',
        'vehicle_type'           => [ 'id' => 'Tipo de Vehículo' ],
        'category'               => [ 'category' => 'Categoría' ],
        'vehicle_make'           => [ 'id' => 'Marca' ],
        'vehicle_model'          => [ 'id' => 'Modelo' ],
        'year'                   => 'Año',
        'license_plate'          => 'Placa',
        'use'                    => 'Uso',
        'mileage'                => 'Kilometraje',
        'color'                  => 'Color',
        'engine'                 => 'Motor',
        'chassis'                => 'Chasis',
        'tonnage_capacity'       => 'Capacidad/Tonelaje',
        'seat_number'            => 'Nº de Asientos',
        ''                       => '',
    ],

    'alpha_space'      => 'El campo :attribute sólo puede contener letras.',
    'alpha_num_space'  => 'El campo :attribute sólo puede contener letras y números.',
    'alpha_dash_space' => 'El campo :attribute sólo puede contener letras, números y guiones.',
    'ands_full'        => 'El campo :attribute sólo puede contener letras, números y guiones',

];
