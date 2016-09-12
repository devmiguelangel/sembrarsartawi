<?php

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Vinkla\Hashids\Facades\Hashids;

function encrypt($value)
{
    return Crypt::encrypt($value);
}

function decrypt($value)
{
    try {
        return Crypt::decrypt($value);
    } catch (DecryptException $e) {
        //
    }
}

function encode($value)
{
    return Hashids::encode($value);
}

function decode($value)
{
    $value = Hashids::decode($value);

    return ( count($value) === 1 ? $value[0] : 0 );
}

function dateToFormat($birthdate)
{
    if ( ! is_null($birthdate)) {
        $carbon = new \Carbon\Carbon();
        $date   = $carbon->createFromTimestamp(strtotime($birthdate));

        return $date->format('d/m/Y');
    }

    return null;
}

function monthES($month)
{
    switch ($month) {
        case 1:
            return 'Enero';
            break;
        case 2:
            return 'Febrero';
            break;
        case 3:
            return 'Marzo';
            break;
        case 4:
            return 'Abril';
            break;
        case 5:
            return 'Mayo';
            break;
        case 6:
            return 'Junio';
            break;
        case 7:
            return 'Julio';
            break;
        case 8:
            return 'Agosto';
            break;
        case 9:
            return 'Septiembre';
            break;
        case 10:
            return 'Octubre';
            break;
        case 11:
            return 'Noviembre';
            break;
        case 12:
            return 'Diciembre';
            break;
    }
}