<?php

return [
    'user_types' => [
        'ADT' => 'Administrador',
        'UST' => 'Usuario',
        'OPT' => 'Operador',
    ],

    'client_types' => [
        'N' => 'Natural',
        'L' => 'Jurídico',
    ],

    'client_document_types' => [
        'CI' => 'Carnet de Identidad',
        'PE' => 'Persona Extranjera',
        'PA' => 'Pasaporte',
        'RUN' => 'Registro Único Nacional',
    ],

    'client_civil_status' => [
        'S' => 'Soltero(a)',
        'C' => 'Casado(a)',
        'D' => 'Divorciado(a)',
        'V' => 'Viudo(a)',
        'F' => 'Unión Libre',
    ],

    'client_genders' => [
        'M' => 'Masculino',
        'F' => 'Femenino',
    ],

    'client_hands' => [
        'R' => 'Derecha',
        'L' => 'Izquierda',
    ],

    'product_types' => [
        'PH' => 'Producto Humanitario',
        'PG' => 'Producto General',
    ],

    'retailer_product_types' => [
        'MP' => 'Producto Principal',
        'SP' => 'Sub Producto',
    ],

    'retailer_image_types' => [
        'A' => 'Artículo',
        'S' => 'Slider',
    ],

    'currencies' => [
        'BS'    => 'Bolivianos',
        'USD'   => 'Dolares',
    ],

    'product_parameters' => [
        'GE' => 'General',
        'FC' => 'Free Cover',
        'AE' => 'Afiliación Automática',
        'FA' => 'Facultativo',
    ],

    'header_types' => [
        'Q' => 'Cotización',
        'I' => 'Emisión',
    ],

    'term_types' => [
        'Y' => 'Años',
        'M' => 'Meses',
        'W' => 'Semanas',
        'D' => 'Días',
    ],

    'headlines' => [
        'D' => 'Deudor',
        'C' => 'Codeudor',
    ],

    'beneficiary_coverages' => [
        'AP' => 'Accidentes Personales',
        'VI' => 'Vida',
        'SP' => 'Sepelio',
        'CO' => 'Contingente',
    ],

    'facultative_states' => [
        'PR' => 'Procesado',
        'PE' => 'Pendiente',
    ],

    'avenue_street' => [
        'A' => 'Avenida',
        'S' => 'Calle',
    ],

    'payment_methods' => [
        'CO' => 'Al Contado',
        'DA' => 'Débito Automático',
    ],

    'account_types' => [
        'CA' => 'Cuenta Corriente',
        'SA' => 'Caja de Ahorro',
    ],

    'account_number_types' => [
        'DC' => 'Tarjeta de Débito',
        'CC' => 'Tarjeta de Crédito',
        'AC' => 'Cuenta',
    ],

    'periods' => [
        'Y' => 'Anual',
        'M' => 'Mensual'
    ],

    'profiles' => [
        'SUP' => 'Supervisor',   // Reportes - Emision
        'REP' => 'Reportes',     // Nacional - Sucursal - Agencia
        'SEP' => 'Vendedor',     // Cotizacion - Emision - Reportes
        'COP' => 'Compañia',     // Procesar casos - Rep. Producto
        'TEP' => 'Pruebas',      // Supervisor
    ],

    'states' => [
        'me' => 'Exámenes Médicos y/o Requisitos',
        're' => 'Reaseguro',
        'cl' => 'Aclaraciones',
        'de' => 'Error en Datos',
    ],

];