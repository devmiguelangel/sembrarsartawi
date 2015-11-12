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

    /*
     * Client Data
     */
    public function getCivilStatus()
    {
        $civil_status = \Config::get('base.client_civil_status');

        return $this->getData($civil_status);
    }

    public function getDocumentType()
    {
        $document_types = \Config::get('base.client_document_types');

        return $this->getData($document_types);
    }

    public function getGender()
    {
        $genders = \Config::get('base.client_genders');

        return $this->getData($genders);
    }
}