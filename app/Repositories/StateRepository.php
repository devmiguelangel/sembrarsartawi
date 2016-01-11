<?php

namespace Sibas\Repositories;

use Sibas\Entities\State;

class StateRepository extends BaseRepository
{
    public function getStatus()
    {
        $selectOption = $this->getSelectOption();

        $status = State::select('id', 'state', 'state as name', 'slug as data_slug')
            ->orderBy('id', 'asc')
            ->get();

        $status = $selectOption->merge($status->toArray());

        return $status;
    }
}