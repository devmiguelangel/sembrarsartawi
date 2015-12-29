<?php

namespace Sibas\Repositories;

use Sibas\Entities\User;

class UserRepository extends BaseRepository
{
    public function getUserByProfile(User $user, array $profiles = [])
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
}