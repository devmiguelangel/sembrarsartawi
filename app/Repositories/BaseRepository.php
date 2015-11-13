<?php

namespace Sibas\Repositories;


use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Sibas\Collections\BaseCollection;
use Vinkla\Hashids\Facades\Hashids;

abstract class BaseRepository
{
    /**
     * @var BaseCollection
     */
    private $collection;

    private $selectOption;

    protected $carbon;

    public function __construct()
    {
        $this->collection   = new BaseCollection();
        $this->selectOption = $this->collection->selectOption();
        $this->carbon       = new Carbon();
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

    protected function cryptData($value)
    {
        return Hashids::encode($value);
    }

    protected function decryptData($value)
    {
        $value = Hashids::decode($value);

        return $value[0];
    }
}