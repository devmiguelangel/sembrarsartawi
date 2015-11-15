<?php

namespace Sibas\Repositories\De;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\De\Detail;

class DetailDeRepository
{
    private $id;

    private $data;

    private $header;

    private $detail;

    private $client;

    private $errors;

    /**
     * @param Request $request
     * @return bool
     */
    public function createDetail($request)
    {
        $this->data   = $request->all();
        $this->header = $this->data['header'];
        $this->client = $this->data['client'];

        try {
            $this->id = date('U');

            $this->detail = new Detail();

            $this->detail->id               = $this->id;
            $this->detail->op_de_header_id  = $this->header->id;
            $this->detail->op_client_id     = $this->client->id;
            $this->detail->percentage_credit = $this->getPercentage();
            $this->detail->rate             = 0;
            $this->detail->balance          = 0;
            $this->detail->cumulus          = 0;
            $this->detail->amount           = 0;
            $this->detail->approved         = false;
            $this->detail->headline         = $this->getHeadlineType();

            if ($this->detail->save()) {
                return true;
            }
        } catch(QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

    public function getHeadlineType()
    {
        if ($this->header->coverage->slug === 'MC') {
            $details = Detail::where('op_de_header_id', $this->header->id)->count();

            if ($details === 1) {
                return 'C';
            }
        }

        return 'D';
    }

    private function getPercentage()
    {
        $percentage = 0;

        switch ($this->header->coverage->slug) {
            case 'IC':
                $percentage = 100;
                break;
            case 'MC':
                $percentage = 50;
                break;
            case 'BC':
                $percentage = 10;
                break;
        }

        return $percentage;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}