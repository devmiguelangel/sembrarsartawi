<?php

namespace Sibas\Repositories\Retailer;

use Illuminate\Support\Collection;
use Sibas\Entities\City;
use Sibas\Repositories\BaseRepository;

class CityRepository extends BaseRepository
{
    private $cities;

    private function getCities()
    {
        return City::select('id', 'id as city_id', 'name', 'abbreviation', 'slug', 'type_ci', 'type_re', 'type_de')
            ->get();
    }

    public function getCitiesByType()
    {
        $this->cities = $this->getCities();
        $selectOption = $this->getSelectOption();

        $cities = [];

        $cities['CI'] = $this->cities->filter(function($item) {
            $item = $this->getDataOptions($item, 'CI');

            return $item->type_ci == 1;
        });

        $cities['RE'] = $this->cities->filter(function($item) {
            $item = $this->getDataOptions($item, 'RE');

            return $item->type_re == 1;
        });

        $cities['DE'] = $this->cities->filter(function($item) {
            $item = $this->getDataOptions($item, 'DE');

            return $item->type_de == 1;
        });

        foreach ($cities as &$city) {
            dd($city);
            $city = $selectOption->merge($city->toArray());
        }

        return $cities;
    }

    /**
     * @param Collection $item
     * @return mixed
     */
    private function getDataOptions($item, $type)
    {
        switch ($type) {
            case 'CI':
                $item->id = $item->abbreviation;
                break;
            case 'RE':
                $item->id = $item->abbreviation;
                break;
            case 'DE':
                $item->id = $item->name;
                break;
        }

        $item->data_city = $item->abbreviation;

        return $item;
    }

}