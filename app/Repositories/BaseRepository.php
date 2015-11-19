<?php

namespace Sibas\Repositories;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Sibas\Collections\BaseCollection;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;
    /**
     * @var BaseCollection
     */
    private $collection;

    private $selectOption;
    /**
     * @var Carbon
     */
    protected $carbon;

    protected $errors;

    protected $data;

    public function __construct()
    {
        $this->collection   = new BaseCollection();
        $this->selectOption = $this->collection->selectOption();
        $this->carbon       = new Carbon();
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /** Save Model
     *
     * @return bool
     */
    public function saveModel()
    {
        try {
            if ($this->model->save()) {
                return true;
            }
        } catch(QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

    protected function getSelectOption()
    {
        return $this->selectOption;
    }

    /** Returns a data forms select
     * @param array $data
     * @return Collection
     */
    protected function getData($data)
    {
        $d = [];

        foreach ($data as $key => $value) {
            $d[] = [
                'id'   => $key,
                'name' => $value
            ];
        }

        return $this->selectOption->merge($d);
    }
}