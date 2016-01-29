<?php

namespace Sibas\Repositories;

use Sibas\Entities\User;

class UserRepository extends BaseRepository
{
    /**
     * @param User $user
     * @param array $profiles
     * @return array
     */
    public function getUsersByProfile(User $user, array $profiles = [])
    {
        $data = [];

        $users = $user->retailer()->first()->users;

        foreach ($users as $user) {
            foreach ($user->profile as $profile) {
                if (in_array($profile->slug, $profiles, true) !== false) {
                    $data[] = $user;
                }

                break;
            }
        }

        return $data;
    }

    /**
     * @param int $retailer_id
     * @return mixed
     */
    public function getUsersByRetailer($retailer_id)
    {
        return User::with('agency', 'city')
            ->whereHas('retailer', function ($q) use ($retailer_id) {
                $q->where('ad_retailers.id', $retailer_id);
            })
            ->where('username', '!=', 'admin')
            ->get();
    }

}