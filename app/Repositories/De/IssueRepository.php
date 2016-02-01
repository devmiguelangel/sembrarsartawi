<?php

namespace Sibas\Repositories\De;

use Sibas\Entities\De\Header;
use Sibas\Http\Controllers\ReportTrait;
use Sibas\Repositories\BaseRepository;

class IssueRepository extends BaseRepository
{
    use ReportTrait;

    public function getHeaderList($request)
    {
        $headers = Header::with('details.client', 'user.city', 'user.agency')
            ->where('type', 'Q');

        $this->filtersByHeader($request, $headers);

        return $headers->get();
    }
}