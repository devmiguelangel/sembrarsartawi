<?php

namespace Sibas\Repositories\De;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\De\Header;
use Sibas\Repositories\BaseRepository;

class HeaderRepository extends BaseRepository
{
    /** Store a newly created Header in DB.
     *
     * @param Request $request
     * @return bool
     */
    public function createHeader($request)
    {
        $user       = $request->user();
        $this->data = $request->all();

        $quote_number = $this->getNumber('quote_number');

        try {
            $this->model = new Header();

            $this->model->id               = date('U');
            $this->model->ad_user_id       = $user->id;
            $this->model->type             = 'Q';
            $this->model->quote_number     = $quote_number;
            $this->model->ad_coverage_id   = $this->data['coverage'];
            $this->model->amount_requested = $this->data['amount_requested'];
            $this->model->currency         = $this->data['currency'];
            $this->model->term             = $this->data['term'];
            $this->model->type_term        = $this->data['type_term'];
            $this->model->issued           = false;

            if (! $this->checkNumber('quote_number', $quote_number)) {
                if ($this->model->save()) {
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

    /** Get next number (Quote - Issue)
     * @param string $field
     * @return int
     */
    private function getNumber($field)
    {
        $max = Header::max($field);

        return is_null($max) ? 1 : $max + 1;
    }

    /** Verifies registration number (Quote - Issue)
     *
     * @param string $field
     * @param int $number
     * @return bool
     */
    private function checkNumber($field, $number)
    {
        $n = Header::where($field, $number)->exists();

        return $n;
    }

    /** Find Header by Id
     * @param $header_id
     * @return bool
     */
    public function getHeaderById($header_id)
    {
        $this->model = Header::where('id', '=', $header_id)->first();

        if (! is_null($this->model)) {
            return true;
        }

        return false;
    }

}