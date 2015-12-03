<?php

namespace Sibas\Http\Controllers;

use Illuminate\Support\Collection;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\De\DataRepository;

class BaseController extends Controller
{
    /**
     * @var DataRepository
     */
    private $repository;

    public function __construct(DataRepository $repository)
    {
        $this->repository = $repository;
    }

    /** Returns list of Currencies
     *
     * @return Collection
     */
    public function currency()
    {
        return $this->repository->getCurrency();
    }

    /** Returns list of Term Types
     *
     * @return Collection
     */
    public function termType()
    {
        return $this->repository->getTermType();
    }

    /** Returns list of Civil Status
     *
     * @return Collection
     */
    public function getCivilStatus()
    {
        return $this->repository->getCivilStatus();
    }

    /** Returns list of Document Types
     *
     * @return Collection
     */
    public function getDocumentType()
    {
        return $this->repository->getDocumentType();
    }

    /** Returns list of Genders
     *
     * @return Collection
     */
    public function getGender()
    {
        return $this->repository->getGender();
    }

    /** Returns list of Hands
     *
     * @return Collection
     */
    public function getHand()
    {
        return $this->repository->getHand();
    }

    /** Returns list of Avenue Street
     *
     * @return Collection
     */
    public function getAvenueStreet()
    {
        return $this->repository->getAvenueStreet();
    }

    /** Returns list of Payment Methods
     *
     * @return Collection
     */
    public function getPaymentMethod()
    {
        return $this->repository->getPaymentMethod();
    }

    /** Returns list of Periods
     *
     * @return Collection
     */
    public function getPeriod()
    {
        return $this->repository->getPeriod();
    }


}
