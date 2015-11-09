<?php

namespace Sibas\Repositories\De;


use Sibas\Repositories\BaseRepository;

class DataRepository extends BaseRepository
{

    public function getCurrency()
    {
        $currencies = \Config::get('base.currencies');

        return $this->getData($currencies);
    }

    public function getTermType()
    {
        $termType = \Config::get('base.term_types');

        return $this->getData($termType);
    }
}