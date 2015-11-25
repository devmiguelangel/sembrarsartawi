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

        $header = new Header();

        $header->id                 = date('U');
        $header->ad_user_id         = $user->id;
        $header->type               = 'I';
        $header->policy_number      = 0;
        $header->issue_number       = 1;
        $header->prefix             = 'VI';
        $header->pre_printed        = false;
        $header->pre_printed_number = 0;
        $header->ad_plan_id         = $this->data['plan'];
        $header->premium            = 0;
        $header->payment_method     = $this->data['payment_method'];
        $header->period             = $this->data['period'];
        $header->issued             = true;
        $header->date_issue         = $this->carbon->format('Y-m-d H:i:s');
        $header->pledged            = false;
        $header->case_number        = '';
        $header->amount_pledged     = 0;
        $header->file               = '';

        dd($header);

        return false;
    }
}