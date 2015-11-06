<?php

return [
    'user_types' => [
        'ADT' => 'Administrador',
        'UST' => 'Usuario',
        'OPT' => 'Operador',
    ],

    'city_types' => [
        1 => 'CI',
        2 => 'Regional',
        3 => 'Departamento',
        4 => 'CI/Regional',
        5 => 'CI/Departamento',
        6 => 'Regional/Departamento',
    ],

    'client_types' => [
        'N' => 'Natural',
        'L' => 'Jur�dico',
    ],

    'client_document_types' => [
        'CI' => 'Carnet de Identidad',
        'PE' => 'Persona Extranjera',
        'PA' => 'Pasaporte',
        'RUN' => 'Registro Unico Nacional',
    ],

    'client_civil_status' => [
        'S' => 'Soltero(a)',
        'C' => 'Casado(a)',
        'D' => 'Divorciado(a)',
        'V' => 'Viudo(a)',
        'F' => 'Uni�n Libre',
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
        'A' => 'Art�culo',
        'S' => 'Slider',
    ],

    'currencies' => [
        'BS'    => 'Bolivianos',
        'USD'   => 'Dolares',
    ],

    'product_parameters' => [
        'GE' => 'General',
        'FC' => 'Free Cover',
        'AE' => 'Afiliaci�n Autom�tica',
        'FA' => 'Facultativo',
    ],

    'header_types' => [
        'Q' => 'Cotizaci�n',
        'I' => 'Emisi�n',
    ],

    'term_types' => [
        'Y' => utf8_encode('A�o'),
        'M' => 'Mes',
        'W' => 'Semana',
        'D' => 'Dia',
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

];