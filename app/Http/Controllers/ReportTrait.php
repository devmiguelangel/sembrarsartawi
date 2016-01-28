<?php

namespace Sibas\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Sibas\Entities\User;
use Sibas\Repositories\Retailer\AgencyRepository;
use Sibas\Repositories\Retailer\CityRepository;

trait ReportTrait
{
    /**
     * @var AgencyRepository
     */
    protected $agencyRepository;
    /**
     * @var CityRepository
     */
    protected $cityRepository;

    protected function getInstance()
    {
        $this->cityRepository   = new CityRepository();
        $this->agencyRepository = new AgencyRepository();
    }

    protected function data(User $user)
    {
        $this->getInstance();

        $retailer = $user->retailer()->first();

        return [
            'cities'   => $this->cityRepository->getCitiesByRetailer($retailer->id),
            'agencies' => $this->agencyRepository->getAgenciesByRetailer($retailer->id),
        ];
    }

    /**
     * @param Request $request
     * @param Builder $builder
     */
    protected function filtersByHeader(Request $request, $builder)
    {
        if ($request->has('policy_number')) {
            $builder = $builder->where('issue_number', 'like', '%' . $request->get('policy_number') . '%');
        }

        if ($request->has('city')) {
            $builder = $builder->whereHas('user.city', function ($q) use ($request) {
                $q->where('slug', $request->get('city'));
            });
        }

        if ($request->has('agency')) {
            $builder = $builder->whereHas('user.agency', function ($q) use ($request) {
                $q->where('slug', $request->get('agency'));
            });
        }

        if ($request->has('username')) {
            $builder = $builder->whereHas('user', function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->get('username') . '%');
            });
        }

        if ($request->has('client')) {
            $builder = $builder->whereHas('details.client', function ($q) use ($request) {
                $q->where(function($q1) use ($request) {
                    $q1->orWhere('first_name', 'like', '%' . $request->get('client') . '%')
                        ->orWhere('last_name', 'like', '%' . $request->get('client') . '%')
                        ->orWhere('mother_last_name', 'like', '%' . $request->get('client') . '%');
                });
            });
        }

        if ($request->has('dni')) {
            $builder = $builder->whereHas('details.client', function ($q) use ($request) {
                $q->where('dni', 'like', '%' . $request->get('dni') . '%');
            });
        }

        if ($request->has('extension')) {
            $builder = $builder->whereHas('details.client', function ($q) use ($request) {
                $q->where('extension', 'like', '%' . $request->get('extension') . '%');
            });
        }

        if ($request->has('date_begin') && $request->has('date_end')) {
            $date_begin = $this->carbon->createFromTimestamp(strtotime(str_replace('/', '-', $request->get('date_begin'))));
            $date_end   = $this->carbon->createFromTimestamp(strtotime(str_replace('/', '-', $request->get('date_end'))));

            $builder = $builder->whereBetween('date_issue', [$date_begin, $date_end]);
        }
    }

}