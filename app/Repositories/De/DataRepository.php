<?php

namespace Sibas\Repositories\De;

use Illuminate\Support\Collection;
use Sibas\Repositories\BaseRepository;

class DataRepository extends BaseRepository
{
    /** Returns list of Currencies
     *
     * @return Collection
     */
    public function getCurrency()
    {
        $currencies = \Config::get('base.currencies');

        return $this->getData($currencies);
    }

    /** Returns list of Term Types
     *
     * @return Collection
     */
    public function getTermType()
    {
        $termType = \Config::get('base.term_types');

        return $this->getData($termType);
    }

    /** Returns list of Civil Status
     *
     * @return Collection
     */
    public function getCivilStatus()
    {
        $civil_status = \Config::get('base.client_civil_status');

        return $this->getData($civil_status);
    }

    /** Returns list of Document Types
     *
     * @return Collection
     */
    public function getDocumentType()
    {
        $document_types = \Config::get('base.client_document_types');

        return $this->getData($document_types);
    }

    /** Returns list of Genders
     *
     * @return Collection
     */
    public function getGender()
    {
        $genders = \Config::get('base.client_genders');

        return $this->getData($genders);
    }

    /** Returns list of Hands
     *
     * @return Collection
     */
    public function getHand()
    {
        $hands = \Config::get('base.client_hands');

        return $this->getData($hands);
    }

    /** Returns list of Avenue Street
     *
     * @return Collection
     */
    public function getAvenueStreet()
    {
        $avenue_street = \Config::get('base.avenue_street');

        return $this->getData($avenue_street);
    }
}