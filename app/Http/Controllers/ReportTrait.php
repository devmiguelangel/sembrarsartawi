<?php

namespace Sibas\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Sibas\Entities\Agency;
use Sibas\Entities\City;
use Sibas\Entities\Permission;
use Sibas\Entities\Profile;
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
     * @var Profile
     */
    protected $profile;

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
        $this->profile  = $this->user->profile()->first();
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

            if ( ! ( $this->user->agency instanceof Agency ) && $this->profile->slug === 'COP') {
                return true;
            } else {
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
    /**
     * REPORTE regla consulta
     * @param type $pref
     * @param type $request
     * @param type $rp_state
     * @return type
     */
    public function role($pref, $request, $rp_state = array()) {
        $consult = [];
        $arr = [];
        foreach ($consult as $key => $value) {
            if ($key == 0) {
                $arr['and'][] = $value;
            } else {
                $arr['or'][] = $value;
            }
        }
        $arr = $this->roleEstado($pref, $rp_state, $request);
        $arr = $this->roleAprobado($pref, $arr, $request);
        
        return $arr;
    }
    /**
     * REPORTE validacion consulta estado
     * @param type $rp_state
     * @param type $request
     * @return string
     */
    public function roleEstado($pref,$rp_state, $request) {
        $est1 = [];
        $con = '`op_'.$pref.'_headers`.`issued` = 0 AND `op_'.$pref.'_headers`.`facultative` = 1 AND `op_'.$pref.'_facultatives`.`state` = "PE" AND ';
        # pendiente
        if ($request->get('pendiente'))
            $est1[] = '(' . $con . '(SELECT COUNT(odo.id) FROM op_'.$pref.'_observations as odo
                    WHERE odo.op_'.$pref.'_facultative_id = op_'.$pref.'_facultatives.id) = 0)';
        # subsanado
        if ($request->get('subsanado'))
            $est1[] = '(' . $con . '(SELECT COUNT(odo.id) FROM op_'.$pref.'_observations as odo
                        WHERE odo.op_'.$pref.'_facultative_id = op_'.$pref.'_facultatives.id
                        AND odo.response = true ORDER BY odo.id DESC) = 1) ';
        # observado
        if ($request->get('observado'))
            $est1[] = '(' . $con . '(SELECT COUNT(odo.id) FROM op_'.$pref.'_observations as odo
                        WHERE odo.op_'.$pref.'_facultative_id = op_'.$pref.'_facultatives.id) > 0) ';

        $est2 = [];
        # validacion con and
        foreach ($rp_state as $key => $value) {
            if ($request->get($value->states->slug))
                $est2[] = '(`op_'.$pref.'_headers`.`issued` = 0 AND `op_'.$pref.'_headers`.`facultative` =1 and `op_'.$pref.'_facultatives`.`state`="PE" and (SELECT MAX(odo.id)
                    FROM op_'.$pref.'_observations as odo
                    inner join op_'.$pref.'_facultatives as fcv on (fcv.id=odo.op_'.$pref.'_facultative_id)
                    inner join ad_states as stat on (odo.ad_state_id = stat.id)
                    WHERE stat.slug = "' . $value->states->slug . '" and fcv.id = op_'.$pref.'_facultatives.id) > 0)';
        }

        $res = [];
        if (count($est1) > 0 && count($est2) > 0) {
            #ambos
            $res['and'][] = array('((' . implode($est1, 'OR') . ') OR (' . implode($est2, 'OR') . '))' => 'block');
        } elseif (count($est1) > 0 && count($est2) == 0) {
            #estados
            $res['and'][] = array('(' . implode($est1, 'OR') . ')' => 'block');
        } elseif (count($est1) == 0 && count($est2) > 0) {
            #subestados
            $res['and'][] = array('(' . implode($est2, 'OR') . ')' => 'block');
        }

        return $res;
    }
    /**
     * REPORTE
     * @param type $pref
     * @param type $arr
     * @param type $request
     * @return int
     */
    public function roleAprobado($pref, $arr, $request){
        
        if($request->get('freecover') && $request->get('no_freecover'))
            $fre = 'or';
        else
            $fre = 'and';

        if ($request->get('freecover'))
            $arr[$fre][] = array('`op_'.$pref.'_headers`.`issued`' => 1, '`op_'.$pref.'_headers`.`facultative`' => 0);

        # no freecover
        if ($request->get('no_freecover'))
            $arr[$fre][] = array('`op_'.$pref.'_headers`.`facultative`' => 1, '`op_'.$pref.'_facultatives`.`state`' => 'PR', '`op_'.$pref.'_facultatives`.`approved`' => 1);

        if($request->get('emitido') && $request->get('no_emitido'))
            $emi = 'or';
        else
            $emi = 'and';
        
        # emitido
        if ($request->get('emitido'))
            $arr[$emi][] = array('`op_'.$pref.'_headers`.`issued`' => 1);

        # no emitido
        if ($request->get('no_emitido'))
            $arr[$emi][] = array('`op_'.$pref.'_headers`.`issued`' => 0);
        
        if($request->get('extraprima') && $request->get('no_extraprima'))
            $ext = 'or';
        else
            $ext = 'and';
        
        # extraprima
        if ($request->get('extraprima'))
            $arr[$ext][] = array('`op_'.$pref.'_facultatives`.`state`' => 'PR', '`op_'.$pref.'_headers`.`facultative`' => 1, '`op_'.$pref.'_facultatives`.`surcharge`' => 1);

        # no extraprima
        if ($request->get('no_extraprima'))
            $arr[$ext][] = array('`op_'.$pref.'_facultatives`.`state`' => 'PR', '`op_'.$pref.'_headers`.`facultative`' => 1, '`op_'.$pref.'_facultatives`.`surcharge`' => 0);
        
        if($request->get('rechazado') && $request->get('anulado'))
            $rec = 'or';
        else
            $rec = 'and';
        
        # rechazados
        if ($request->get('rechazado'))
            $arr[$rec][] = array('`op_'.$pref.'_facultatives`.`approved`' => 0, '`op_'.$pref.'_facultatives`.`state`' => 'PR');

        # polizas anuladas
        if ($request->get('anulado'))
            $arr[$rec][] = array('`op_'.$pref.'_headers`.`issued`' => 1, '`op_'.$pref.'_headers`.`canceled`' => 1);
        
        return $arr;
    }

}
