<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 04/12/2015
 * Time: 17:15
 */

namespace Sibas\Repositories\Admin;


use Sibas\Entities\City;
use Sibas\Repositories\BaseRepository;

class CityAdminRepository extends BaseRepository{

    public function listCity(){

        $this->model = City::get();

        if($this->model->count() > 0){
            return true;
        }

        return false;
    }
}