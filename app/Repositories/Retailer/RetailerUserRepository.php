<?php

namespace Sibas\Repositories\Retailer;

use Sibas\Entities\RetailerUser;

class RetailerUserRepository
{

    /**
     * @param \Sibas\Entities\User $user
     * @return RetailerUser
     */
    public function getDetailForUser($user)
    {
        return RetailerUser::where('ad_user_id', $user->id)->firstOrFail();
    }
}