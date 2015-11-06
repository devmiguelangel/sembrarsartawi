<?php

namespace Sibas\Components;


class SelectFieldBuilder
{
    public function __construct()
    {
        Form::macro('sumthin', function()
        {
            return '<input type="sumthin" value="default">';
        });
    }
}