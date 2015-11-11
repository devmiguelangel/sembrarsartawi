<?php

namespace Sibas\Repositories\De;

use Illuminate\Database\QueryException;
use Sibas\Entities\De\Header;
use Sibas\Http\Requests\De\HeaderCreateFormRequest;
use Sibas\Repositories\BaseRepository;

class HeaderRepository extends BaseRepository
{
    public $id;

    public $errors;

    /**
     * @param HeaderCreateFormRequest $request
     * @return bool
     */
    public function saveQuote($request)
    {
        $user = $request->user();
        $data = $request->all();
        //dd($data);
        $quote_number = $this->getNumber('quote_number');

        try {
            $header = new Header();

            $header->id               = date('U');
            $header->ad_user_id       = $user->id;
            $header->type             = 'Q';
            $header->quote_number     = $quote_number;
            $header->ad_coverage_id   = $data['coverage'];
            $header->amount_requested = $data['amount_requested'];
            $header->currency         = $data['currency'];
            $header->term             = $data['term'];
            $header->type_term        = $data['type_term'];
            $header->issued = false;

            if (! $this->checkNumber('quote_number', $quote_number)) {
                if ($header->save()) {
                    $this->id = $this->cryptData($header->id);

                    return true;
                }
            }
        } catch(QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

    /**
     * @param String $field
     * @return int
     */
    private function getNumber($field)
    {
        $max = Header::max($field);

        return is_null($max) ? 1 : $max + 1;
    }

    /**
     * @param String $field
     * @param Int $number
     * @return bool
     */
    private function checkNumber($field, $number)
    {
        $n = Header::where($field, $number)->exists();

        return $n;
    }
}