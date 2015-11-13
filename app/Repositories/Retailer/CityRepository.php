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
        return City::select('id', 'id as city_id', 'name', 'abbreviation', 'slug', 'type_ci', 'type_re', 'type_de');
    }

    public function getCitiesByType()
    {
        $this->cities = $this->getCities();
        $selectOption = $this->getSelectOption();

        $cities = [];

        $cities['CI'] = $this->cities->get()->filter(function($item) {
            $item = $this->getDataOptions($item, 'CI');

            if ($item->type_ci == 1) {
                return $item;
            }
        });

        $cities['RE'] = $this->cities->get()->filter(function($item) {
            $item = $this->getDataOptions($item, 'RE');

            if ($item->type_re == 1) {
                return $item;
            }
        });

        $cities['DE'] = $this->cities->get()->filter(function($item) {
            $item = $this->getDataOptions($item, 'DE');

            if ($item->type_de == 1) {
                return $item;
            }
        });


        foreach ($cities as &$city) {
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
                $item->id = $item->slug;
                break;
        }

        $item->data_city = $item->abbreviation;

        return $item;
    }

}