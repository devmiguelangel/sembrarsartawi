<?php

namespace Sibas\Repositories\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Sibas\Entities\De\Response;
use Sibas\Repositories\BaseRepository;

class QuestionRepository extends BaseRepository
{
    /**
     * Store Question response for Detail
     *
     * @param Request $request
     * @return bool
     */
    public function storeQuestionDe($request)
    {
        $this->data = $request->all();
        $detail     = $this->data['detail'];

        if ((int) $this->data['qs_number'] === count($this->data['qs'])) {
            foreach ($this->data['qs'] as &$qs) {
                $qs['expected'] = (boolean) $qs['expected'];
                $qs['response'] = (boolean) $qs['response'];
            }

            $this->model = new Response();

            $this->model->id              = date('U');
            $this->model->op_de_detail_id = $detail->id;
            $this->model->response        = json_encode($this->data['qs']);
            $this->model->observation     = $this->data['qs_observation'];

            return $this->saveModel();
        }

        return false;
    }

    /**
     * Update Question response for Detail
     *
     * @param Request $request
     * @return bool
     */
    public function updateQuestionDe($request)
    {
        $this->data = $request->all();
        $detail     = $request['detail'];

        if ((int) $this->data['qs_number'] === count($this->data['qs'])) {
            $this->model = $detail->response;

            $this->model->response    = json_encode($this->data['qs']);
            $this->model->observation = $this->data['qs_observation'];

            return $this->saveModel();
        }

        return false;
    }

    /**
     * Get Response For Edit
     *
     * @param Collection $response
     * @return mixed
     */
    public function getQuestionsByResponse($response)
    {
        $questions = json_decode($response, true);

        foreach ($questions as $key => &$question) {
            $check_yes = ($question['response'] ? true : false);
            $check_no  = !($question['response'] ? true : false);

            $question['check_yes'] = $check_yes;
            $question['check_no']  = $check_no;
            $question['order']     = $key;
            $question['expected']  = (int) $question['expected'];
        }

        return $questions;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}