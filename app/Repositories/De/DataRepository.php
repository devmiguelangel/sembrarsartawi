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
        $currencies = config('base.currencies');

        return $this->getData($currencies);
    }


    /** Returns list of Term Types
     *
     * @return Collection
     */
    public function getTermType()
    {
        $termType = config('base.term_types');

        return $this->getData($termType);
    }


    /** Returns list of Civil Status
     *
     * @return Collection
     */
    public function getCivilStatus()
    {
        $civil_status = config('base.client_civil_status');

        return $this->getData($civil_status);
    }


    /** Returns list of Document Types
     *
     * @return Collection
     */
    public function getDocumentType()
    {
        $document_types = config('base.client_document_types');

        return $this->getData($document_types);
    }


    /** Returns list of Genders
     *
     * @return Collection
     */
    public function getGender()
    {
        $genders = config('base.client_genders');

        return $this->getData($genders);
    }


    /** Returns list of Hands
     *
     * @return Collection
     */
    public function getHand()
    {
        $hands = config('base.client_hands');

        return $this->getData($hands);
    }


    /** Returns list of Avenue Street
     *
     * @return Collection
     */
    public function getAvenueStreet()
    {
        $avenue_street = config('base.avenue_street');

        return $this->getData($avenue_street);
    }


    /** Returns list of Payment Methods
     *
     * @return Collection
     */
    public function getPaymentMethod()
    {
        $payment_methods = config('base.payment_methods');

        return $this->getData($payment_methods);
    }


    /** Returns list of Periods
     *
     * @return Collection
     */
    public function getPeriod()
    {
        $periods = config('base.periods');

        return $this->getData($periods);
    }


    /** Returns list of Vehicle Categories
     *
     * @return Collection
     */
    public function getVehicleCategory()
    {
        $vehicle_categories = config('base.vehicle_category');

        return $this->getData($vehicle_categories);
    }


    /** Returns list of Vehicle Uses
     *
     * @return Collection
     */
    public function getVehicleUse()
    {
        $vehicle_uses = config('base.vehicle_use');

        return $this->getData($vehicle_uses);
    }


    public function getMovementType()
    {
        $movement_types = config('base.movement_types');

        return $this->getData($movement_types);
    }

}