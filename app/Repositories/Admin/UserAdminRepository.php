<?php


namespace Sibas\Repositories\Admin;


use Sibas\Entities\User;
use Sibas\Repositories\BaseRepository;

class UserAdminRepository extends BaseRepository{

    public function listUser()
    {
        $this->model = User::join('ad_user_types', 'ad_users.ad_user_type_id', '=', 'ad_user_types.id')
                            ->leftjoin('ad_cities', 'ad_users.ad_city_id', '=', 'ad_cities.id')
                            ->leftjoin('ad_agencies', 'ad_users.ad_agency_id', '=', 'ad_agencies.id')
                            ->select('ad_users.id as id_user', 'ad_user_types.name as type', 'ad_users.username', 'ad_users.full_name', 'ad_users.email', 'ad_cities.name as cities', 'ad_agencies.name as agencies', 'ad_users.active')
                            ->get();

        if ($this->model->count() > 0) {

            return true;
        }

        return false;
    }
}