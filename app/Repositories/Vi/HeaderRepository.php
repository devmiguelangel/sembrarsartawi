<?php

namespace Sibas\Repositories\Vi;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Vi\Header;
use Sibas\Repositories\BaseRepository;

class HeaderRepository extends BaseRepository
{
    public function storeSubProduct(Request $request)
    {
        $user       = $request->user();
        $this->data = $request->all();
        $policies   = $this->data['policies'];
        $plans      = $this->data['plans'];
        $detail     = $this->data['detail'];

        $plan = $plans->filter(function($item) {
            return $item['id'] == $this->data['plan'];
        });

        $plan = $plan->first();

        if ($policies->count() === 1) {
            $policy = $policies->first();

            $this->model = new Header();

            $this->model->id                 = date('U');
            $this->model->ad_user_id         = $user->id;
            $this->model->type               = 'I';
            $this->model->policy_number      = $this->getNumber('policy_number', $policy->number);
            $this->model->issue_number       = $this->getNumber('issue_number');
            $this->model->prefix             = 'VI';
            $this->model->pre_printed        = false;
            $this->model->pre_printed_number = 0;
            $this->model->ad_plan_id         = $plan['id'];
            $this->model->premium            = $plan['annual_premium'];
            $this->model->payment_method     = $this->data['payment_method'];
            $this->model->period             = $this->data['period'];
            $this->model->issued             = true;
            $this->model->date_issue         = $this->carbon->format('Y-m-d H:i:s');
            $this->model->pledged            = false;
            $this->model->case_number        = '';
            $this->model->amount_pledged     = 0;
            $this->model->file               = '';

            if ($this->saveModel()) {
                try {
                    $detailVi = $this->model->details()->create([
                        'id'              => date('U'),
                        'op_client_id'    => $detail->client->id,
                        'currency'        => 'BS',
                        'client_code'     => $detail->client->code,
                        'taker_name'      => $this->data['taker_name'],
                        'taker_dni'       => $this->data['taker_dni'],
                    ]);

                    $detailVi->response()->create([
                        'id'          => date('U'),
                        'response'    => json_encode($this->data['qs']),
                        'observation' => '',
                    ]);

                    $beneficiaries  = [];
                    $beneficiary_id = date('U');

                    foreach ($this->data['beneficiaries'] as $key => $beneficiary) {
                        array_push($beneficiaries, [
                            'id'               => $beneficiary_id + $key,
                            'coverage'         => 'VI',
                            'first_name'       => $beneficiary['first_name'],
                            'last_name'        => $beneficiary['last_name'],
                            'mother_last_name' => $beneficiary['mother_last_name'],
                            'dni'              => $beneficiary['dni'],
                            'relationship'     => $beneficiary['relationship'],
                            'participation'    => $beneficiary['participation'],
                        ]);
                    }

                    $detailVi->beneficiaries()->createMany($beneficiaries);

                    return true;
                } catch(QueryException $e) {
                    $this->errors = $e->getMessage();
                }
            }
        }

        return false;
    }

    /**
     * @param $field
     * @param int $default
     * @return int
     */
    private function getNumber($field, $default = 1)
    {
        $max = Header::max($field);

        return is_null($max) ? $default : $max + 1;
    }
}