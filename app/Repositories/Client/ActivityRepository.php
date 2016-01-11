<?php

namespace Sibas\Repositories\Client;

use Sibas\Entities\Activity;
use Sibas\Repositories\BaseRepository;

class ActivityRepository extends BaseRepository
{
    public function getActivities()
    {
        $selectOption = $this->getSelectOption();

        $activities = Activity::select('id', 'category', 'occupation')
            ->orderBy('id', 'asc')
            ->get();

        $activities = $selectOption->merge($activities->toArray());

        return $activities;
    }
}