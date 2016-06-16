<?php

namespace Sibas\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Sibas\Entities\Agency;
use Sibas\Entities\City;
use Sibas\Entities\Permission;
use Sibas\Entities\Retailer;
use Sibas\Entities\User;
use Sibas\Repositories\Retailer\AgencyRepository;
use Sibas\Repositories\Retailer\CityRepository;
use Sibas\Repositories\UserRepository;

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

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Retailer
     */
    protected $retailer;

    /**
     * @var Collection
     */
    protected $cities;

    /**
     * @var Collection
     */
    protected $agencies;

    /**
     * @var Collection
     */
    protected $users;


    protected function getInstance()
    {
        $this->cityRepository   = new CityRepository();
        $this->agencyRepository = new AgencyRepository();
        $this->userRepository   = new UserRepository();
    }


    /**
     * @param User $user
     *
     * @return array
     */
    protected function data(User $user)
    {
        $this->getInstance();

        $this->user     = $user;
        $this->retailer = $this->user->retailerUser->retailer;

        $this->getDataForReport();

        return [
            'cities'   => $this->cities,
            'agencies' => $this->agencies,
            'users'    => $this->users,
        ];
    }


    /**
     * @param Request     $request
     * @param Builder     $builder
     * @param string|null $product
     */
    protected function filtersByHeader(Request $request, $builder, $product = null)
    {
        $client = 'details.client';

        if ($product === 'au' || $product === 'td') {
            $client = 'client';
        }

        if ($request->has('policy_number')) {
            $builder = $builder->where('issue_number', 'like', '%' . $request->get('policy_number') . '%');
        } elseif ($request->has('quote_number')) {
            $builder = $builder->where('quote_number', 'like', '%' . $request->get('quote_number') . '%');
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
            $builder = $builder->whereHas($client, function ($q) use ($request) {
                $q->where(function ($q1) use ($request) {
                    $q1->orWhere('first_name', 'like', '%' . $request->get('client') . '%')->orWhere('last_name',
                        'like', '%' . $request->get('client') . '%')->orWhere('mother_last_name', 'like',
                        '%' . $request->get('client') . '%');
                });
            });
        }

        if ($request->has('dni')) {
            $builder = $builder->whereHas($client, function ($q) use ($request) {
                $q->where('dni', 'like', '%' . $request->get('dni') . '%');
            });
        }

        if ($request->has('extension')) {
            $builder = $builder->whereHas($client, function ($q) use ($request) {
                $q->where('extension', 'like', '%' . $request->get('extension') . '%');
            });
        }

        if ($request->has('date_begin') && $request->has('date_end')) {
            $date_begin = $this->carbon->createFromTimestamp(strtotime(str_replace('/', '-',
                $request->get('date_begin'))));
            $date_end   = $this->carbon->createFromTimestamp(strtotime(str_replace('/', '-',
                $request->get('date_end'))));

            $builder = $builder->whereBetween('created_at', [ $date_begin, $date_end ]);
        }
    }


    protected function getDataForReport()
    {
        $this->cities   = $this->cityRepository->getCitiesByRetailer($this->retailer->id);
        $this->agencies = $this->agencyRepository->getAgenciesByRetailer($this->retailer->id);
        $this->users    = $this->userRepository->getUsersByRetailer($this->retailer->id);
        $permission     = $this->getPermissionForReport($this->user);

        /*
         * Cities
         */
        $this->cities = $this->cities->filter(function ($item) use ($permission) {
            $item->id = $item->slug;

            if ($permission === 'RU' || $permission === 'RA' || $permission === 'RR') {
                if ($item->slug === $this->user->city->slug) {
                    return true;
                }
            } elseif ($permission === 'RN') {
                return true;
            }
        })->toArray();

        /*
         * Agencies
         */
        $this->agencies = $this->agencies->filter(function ($item) use ($permission) {
            $item->id = $item->slug;

            if ($permission === 'RU' || $permission === 'RA') {
                if ($item->slug === $this->user->agency->slug) {
                    return true;
                }
            } elseif ($permission === 'RR') {
                foreach ($item->retailerCityAgencies as $retailerCityAgency) {
                    if ($retailerCityAgency->retailerCity->ad_city_id === $this->user->city->id) {
                        return true;
                    }
                }
            } elseif ($permission === 'RN') {
                return true;
            }
        })->toArray();

        /*
         * Users
         */
        $this->users = $this->users->filter(function ($item) use ($permission) {
            $item->id   = $item->username;
            $item->name = $item->full_name;

            if ($permission === 'RU') {
                if ($item->username === $this->user->username) {
                    return true;
                }
            } elseif ($permission === 'RA') {
                if (( $item->agency instanceof Agency ) && ( $item->agency->id === $this->user->agency->id )) {
                    return true;
                }
            } elseif ($permission === 'RR') {
                if (( $item->city instanceof City ) && ( $item->city->id === $this->user->city->id )) {
                    return true;
                }
            } elseif ($permission === 'RN') {
                if (( $item->agency instanceof Agency ) && ( $item->city instanceof City )) {
                    return true;
                }
            }
        })->toArray();

        if ($permission !== 'RU') {
            $users       = $this->getSelectOption();
            $this->users = $users->merge($this->users)->toArray();

            if ($permission === 'RN' || $permission === 'RR') {
                $agencies       = $this->getSelectOption();
                $this->agencies = $agencies->merge($this->agencies)->toArray();

                if ($permission === 'RN') {
                    $cities       = $this->getSelectOption();
                    $this->cities = $cities->merge($this->cities)->toArray();
                }
            }
        }
    }


    /**
     * @return Collection
     */
    protected function getSelectOption()
    {
        return collect([
            [
                'id'   => '',
                'name' => 'Todos',
            ]
        ]);
    }


    protected function getPermissionForReport($user)
    {
        $permission = null;

        foreach ($user->permissions as $permission) {
            if ($permission->slug === 'RN') {
                break;
            } elseif ($permission->slug === 'RR') {
                break;
            } elseif ($permission->slug === 'RA') {
                break;
            } elseif ($permission->slug === 'RU') {
                break;
            }
        }

        return ( $permission instanceof Permission ) ? $permission->slug : 'RU';
    }

}