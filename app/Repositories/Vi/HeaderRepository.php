<?php

namespace Sibas\Repositories\Vi;

use Illuminate\Http\Request;
use Sibas\Entities\Vi\Header;
use Sibas\Repositories\BaseRepository;

class HeaderRepository extends BaseRepository
{
    public function storeHeaderSubProduct(Request $request)
    {
        $user       = $request->user();
        $this->data = $request->all();
        $policies   = $this->data['policies'];
        $plans      = $this->data['plans'];

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

            return $this->saveModel();
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