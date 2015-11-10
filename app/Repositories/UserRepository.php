<?php

namespace Sibas\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Sibas\Entities\User;

class UserRepository
{
    /**
     * @param $user_id
     * @return Collection
     */
    public function getRetailerByUser($user_id)
    {
        $user = User::where('id', $user_id)->firstOrFail();

        return $user->retailer->first();
    }
}