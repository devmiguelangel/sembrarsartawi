<?php

namespace Sibas\Http\Controllers;

use Illuminate\Http\Request;
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

    public function currency()
    {
        return $this->repository->getCurrency();
    }

    public function termType()
    {
        return $this->repository->getTermType();
    }

    /*
     * Client Data
     */
    public function getCivilStatus()
    {
        return $this->repository->getCivilStatus();
    }

    public function getDocumentType()
    {
        return $this->repository->getDocumentType();
    }

    public function getGender()
    {
        return $this->repository->getGender();
    }
}