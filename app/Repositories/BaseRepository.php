<?php

namespace Sibas\Repositories;


use Sibas\Collections\BaseCollection;

abstract class BaseRepository
{
    /**
     * @var BaseCollection
     */
    private $collection;

    private $selectOption;

    public function __construct()
    {
        $this->collection   = new BaseCollection();
        $this->selectOption = $this->collection->selectOption();
    }

    protected function getSelectOption()
    {
        return $this->selectOption;
    }

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