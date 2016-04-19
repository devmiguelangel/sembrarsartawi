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

    return (count($value) === 1 ? $value[0] : 0);
}

function dateToFormat($birthdate)
{
    if (!is_null($birthdate)) {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->createFromTimestamp(strtotime($birthdate));

        return $date->format('d/m/Y');
    }

    return null;
}