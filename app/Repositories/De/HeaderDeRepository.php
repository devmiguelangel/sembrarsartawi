<?php

namespace Sibas\Repositories\De;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\De\Header;
use Sibas\Http\Requests\De\HeaderDeCreateFormRequest;
use Sibas\Repositories\BaseRepository;

class HeaderDeRepository extends BaseRepository
{
    private $id;

    private $errors;

    private $data;

    /**
     * @param HeaderDeCreateFormRequest $request
     * @return bool
     */
    public function saveQuote($request)
    {
        $user       = $request->user();
        $this->data = $request->all();

        $quote_number = $this->getNumber('quote_number');

        try {
            $this->id = date('U');

            $header = new Header();

            $header->id               = $this->id;
            $header->ad_user_id       = $user->id;
            $header->type             = 'Q';
            $header->quote_number     = $quote_number;
            $header->ad_coverage_id   = $this->data['coverage'];
            $header->amount_requested = $this->data['amount_requested'];
            $header->currency         = $this->data['currency'];
            $header->term             = $this->data['term'];
            $header->type_term        = $this->data['type_term'];
            $header->issued = false;

            if (! $this->checkNumber('quote_number', $quote_number)) {
                if ($header->save()) {
                    return true;
                }
            }
        } catch(QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function updateHeader($request)
    {
        $this->data = $request->all();

        try {
            $header       = $this->getHeaderById($this->data['header_id']);
            $issue_number = $this->getNumber('issue_number');

            $header->type             = 'I';
            $header->issue_number     = $issue_number;
            $header->prefix           = 'DE';
            $header->policy_number    = $this->data['policy_number'];
            $header->operation_number = $this->data['operation_number'];

            if (! $this->checkNumber('issue_number', $issue_number)) {
                if ($header->save()) {
                    return true;
                }
            }
        } catch(QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

    public function issueHeader($header_id)
    {
        try {
            $header = $this->getHeaderById($header_id);
            $carbon = new Carbon;

            $header->issued     = true;
            $header->date_issue = $carbon->format('Y-m-d H:i:s');
            $header->approved   = true;

            if ($header->save()) {
                return true;
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

    public function getHeaderById($header_id)
    {
        $header = Header::where('id', decode($header_id))
            ->first();

        if (! is_null($header)) {
            return $header;
        }

        return false;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function getHeaderTypeById($id)
    {
        $header = Header::select('id', 'type', 'ad_coverage_id')
            ->where('id', decode($id))
            ->first();

        if (! is_null($header)) {
            return $header;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}