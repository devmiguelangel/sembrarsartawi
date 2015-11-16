<?php

namespace Sibas\Repositories\Client;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\De\Response;

class QuestionRepository
{
    private $data;

    private $errors;

    /**
     * @param Request $request
     * @return bool
     */
    public function saveQuestionDe($request)
    {
        $this->data = $request->all();

        $header = $this->data['header'];

        $detail_id = null;

        foreach ($header->details as $detail) {
            if ($detail->client->id === decode($this->data['client_id'])) {
                $detail_id = $detail->id;
                break;
            }
        }

        try {
            if ((int) $this->data['qs_number'] === count($this->data['qs'])) {
                $question = new Response();

                $question->id              = date('U');
                $question->op_de_detail_id = $detail_id;
                $question->response        = json_encode($this->data['qs']);
                $question->observation     = $this->data['qs_observation'];

                if ($question->save()) {
                    return true;
                }
            }
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}