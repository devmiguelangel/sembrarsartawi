<?php

namespace Sibas\Repositories\Vi;

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

        $plan = $plans->filter(function($item) {
            return $item['id'] == $this->data['plan'];
        });

        $plan = $plan->first();

        if ($policies->count() === 1) {
            $policy = $policies->first();

            $header = new Header();

            $header->id                 = date('U');
            $header->ad_user_id         = $user->id;
            $header->type               = 'I';
            $header->policy_number      = $this->getNumber('policy_number', $policy->number);
            $header->issue_number       = $this->getNumber('issue_number');
            $header->prefix             = 'VI';
            $header->pre_printed        = false;
            $header->pre_printed_number = 0;
            $header->ad_plan_id         = $plan['id'];
            $header->premium            = $plan['annual_premium'];
            $header->payment_method     = $this->data['payment_method'];
            $header->period             = $this->data['period'];
            $header->issued             = true;
            $header->date_issue         = $this->carbon->format('Y-m-d H:i:s');
            $header->pledged            = false;
            $header->case_number        = '';
            $header->amount_pledged     = 0;
            $header->file               = '';

            

        }


        dd($header);

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