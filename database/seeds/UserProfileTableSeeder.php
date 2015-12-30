<?php

use Sibas\Entities\UserProfile;

class UserProfileTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new UserProfile();
    }

    protected function getData()
    {
        $data = [];

        $user = $this->getModelData('User')->last();

        $profiles = $this->getModelData('Profile');

        foreach ($profiles as $profile) {
            if ($profile->slug === 'COP') {
                $data[] = [
                    'ad_user_id'    => $user->id,
                    'ad_profile_id' => $profile->id,
                    'active'        => true,
                ];
            }
        }

        return $data;
    }
}
