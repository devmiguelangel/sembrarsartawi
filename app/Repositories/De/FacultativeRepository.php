<?php

namespace Sibas\Repositories\De;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\De\Facultative;
use Sibas\Entities\De\Observation;
use Sibas\Entities\ProductParameter;
use Sibas\Http\Controllers\MailController;
use Sibas\Repositories\BaseRepository;

class FacultativeRepository extends BaseRepository
{

    /**
     * @var ProductParameter
     */
    private $parameter = null;

    /**
     * @var array
     */
    protected $props = [
        'reason' => '',
        'state'  => '',
    ];


    /**
     * Get Facultative records
     *
     * @param        $user
     * @param string $inbox
     * @param int    $header_id
     *
     * @return mixed
     */
    public function getRecords($user, $inbox, $header_id = null)
    {
        $user_type = $user->profile->first()->slug;

        $fa = Facultative::with('user', 'detail.header.user', 'detail.client', 'observations.state',
            'observations.user');

        switch ($user_type) {
            case 'SEP':
                $fa->whereHas('detail.header', function ($query) use ($user) {
                    $query->where('ad_user_id', $user->id)->where('type', 'I')->where('issued', 0);
                });
                break;
            case 'COP':
                $fa->whereHas('detail.header', function ($query) use ($user, $header_id) {
                    $query->where('type', 'I')->where('issued', '=', false)->where('issued', 0);

                    if ( ! is_null($header_id)) {
                        $query->where('id', $header_id);
                    }
                })->where('state', 'PE');
                break;
        }

        $fa = $fa->orderBy('created_at', 'desc')->get();

        $this->records['all'] = $fa;

        $fa->each(function ($item, $key) use ($user_type) {
            // All
            if ($user_type === 'SEP') {
                if ( ! $item->read) {
                    $this->records['all-unread']->push($item);
                }
            } else {
                $this->records['all-unread']->push($item);
            }

            // Approved
            if ($item->state === 'PR' && $item->approved) {
                $this->records['approved']->push($item);

                if ( ! $item->read) {
                    $this->records['approved-unread']->push($item);
                }

                return true;
            }

            // Observed
            if ($item->state === 'PE' && $item->observations->count() > 0) {
                $this->records['observed']->push($item);

                if ( ! $item->read) {
                    $this->records['observed-unread']->push($item);
                }

                return true;
            }

            // Rejected
            if ($item->state === 'PR' && ! $item->approved) {
                $this->records['rejected']->push($item);

                if ( ! $item->read) {
                    $this->records['rejected-unread']->push($item);
                }

                return true;
            }
        });

        $this->records['inbox'] = $this->records[$inbox];

        return $this->records;
    }


    /**
     * @param Request $request
     *
     * @return bool
     */
    public function storeFacultative(Request $request, $rp_id)
    {
        $header          = $request['header'];
        $detail          = $request['detail'];
        $retailer        = $request['retailer'];
        $retailerProduct = $retailer->retailerProducts()->where('id', $rp_id)->first();

        if ($retailerProduct->facultative) {
            if ($this->getParameter($retailerProduct, $detail->amount, $detail->cumulus)) {
                $evaluation = $this->evaluation($detail);

                try {
                    if ($detail->facultative instanceof Facultative) {
                        if ($evaluation) {
                            $detail->facultative()->update($this->props);

                            return true;
                        } else {
                            $detail->facultative()->delete();
                        }
                    } else {
                        if ($evaluation) {
                            $detail->facultative()->create([
                                'id'     => date('U'),
                                'reason' => $this->props['reason'],
                                'state'  => $this->props['state'],
                            ]);

                            return true;
                        }
                    }
                } catch (QueryException $e) {
                    $this->errors = $e->getMessage();
                }
            }
        }

        return false;
    }


    private function evaluation($detail)
    {
        switch ($this->parameter->slug) {
            case 'FC':

                break;
            case 'AE':
                return $this->setAeEvaluation($detail);
                break;
            case 'FA':
                return $this->setAeEvaluation($detail);
                break;
        }

        return false;
    }


    private function setAeEvaluation($detail)
    {
        $facultative = false;
        $response    = $this->getEvaluationResponse($detail->response);
        // $imc         = $detail->client->imc;
        $reason = '';

        /*if ($imc) {
            $reason .= str_replace([ ':name' ], [ $detail->client->full_name ], $this->reasonImc) . '<br>';

            $facultative = true;
        }*/

        if ($response) {
            $reason .= str_replace([ ':name' ], [ $detail->client->full_name ], $this->reasonResponse) . '<br>';

            $facultative = true;
        }

        if ($this->parameter->slug == 'FA') {
            $reason .= str_replace([ ':name', ':cumulus', ':amount_max' ], [
                    $detail->client->full_name,
                    number_format($detail->cumulus, 2),
                    number_format(( $this->parameter->amount_min - 1 ), 2)
                ], $this->reasonCumulus) . '<br>';

            $facultative = true;
        }

        if ($facultative) {
            $this->props['reason'] = $reason;
            $this->props['state']  = 'PE';
        }

        return $facultative;
    }


    private function getParameter($retailerProduct, $amount, $cumulus)
    {
        $cumulus_bs = $cumulus * $retailerProduct->retailer->exchangeRate->bs_value;

        foreach ($retailerProduct->parameters as $parameter) {
            if (( $cumulus_bs >= $parameter->amount_min && $cumulus_bs <= $parameter->amount_max ) || ( $parameter->slug === 'FA' && $cumulus_bs > $parameter->amount_max )) {
                $this->parameter = $parameter;
            }
        }

        if ($this->parameter instanceof ProductParameter) {
            return true;
        }

        return false;
    }


    public function getFacultativeById($id)
    {
        $this->model = Facultative::with('detail.header.user', 'detail.client', 'observations')->where('id', '=',
            $id)->get();

        if ($this->model->count() === 1) {
            $this->model = $this->model->first();

            return true;
        }

        return false;
    }


    /**
     * @param Request $request
     *
     * @return bool
     */
    public function updateFacultative($request)
    {
        $user       = $request->user();
        $this->data = $request->all();

        $this->data['approved']  = (int) $this->data['approved'];
        $this->data['surcharge'] = (boolean) $this->data['surcharge'];

        $_obs = $this->data['observation'];

        if ($this->data['approved'] === 1 || $this->data['approved'] == 0) {
            $this->model->ad_user_id  = $user->id;
            $this->model->state       = 'PR';
            $this->model->observation = $_obs;

            if ($this->data['approved'] === 1) {
                $this->model->approved = true;

                if ($this->data['surcharge']) {
                    $this->model->surcharge    = true;
                    $this->model->percentage   = $this->data['percentage'];
                    $this->model->current_rate = $this->data['current_rate'];
                    $this->model->final_rate   = $this->data['final_rate'];
                } else {
                    $this->model->surcharge    = false;
                    $this->model->current_rate = $this->data['current_rate'];
                    $this->model->final_rate   = $this->data['final_rate'];
                }

                $this->model->detail()->update([
                    'approved' => true
                ]);
            } else {
                $this->model->detail()->update([
                    'rejected' => true
                ]);

                $this->model->approved = false;
            }
        } elseif ($this->data['approved'] === 2) {
            $observation = new Observation([
                'id'          => date('U'),
                'ad_user_id'  => $user->id,
                'ad_state_id' => $this->data['state']['id'],
                'observation' => $_obs,
            ]);

            if ($this->data['state']['data_slug'] === 'me') {
                $observation->op_mc_answer_id = $this->data['mc_id'];
            }

            try {
                $this->model->observations()->save($observation);
            } catch (QueryException $e) {
                $this->errors = $e->getMessage();
            }
        }

        $this->model->read = false;

        return $this->saveModel();
    }


    /**
     * @param Request $request
     *
     * @return bool
     */
    public function storeAnswer($request, $id_observation)
    {
        $user       = $request->user();
        $this->data = $request->all();

        $this->model->observations()->where('id', $id_observation)->update([
            'response'             => true,
            'observation_response' => $this->data['observation_response'],
            'date_response'        => new Carbon()
        ]);

        return $this->saveModel();
    }


    public function readUpdate(Request $request, $id)
    {
        if ($this->getFacultativeById($id)) {
            $this->data = $request->all();
            $read       = filter_var($this->data['read'], FILTER_VALIDATE_BOOLEAN);

            $this->model->read = $read;

            return $this->saveModel();
        }

        return false;
    }


    /**
     * @param MailController $mail
     * @param string         $rp_id
     * @param string         $id
     * @param bool           $response
     *
     * @return bool
     */
    public function sendProcessMail(MailController $mail, $rp_id, $id, $response = false)
    {
        if ($this->getFacultativeById(decode($id)) && is_int($this->approved)) {
            $this->fa     = $this->getModel();
            $this->header = $this->fa->detail->header;
            $this->client = $this->fa->detail->client;

            $this->sendMail($mail, $rp_id, $response);
        }

        return false;
    }

}