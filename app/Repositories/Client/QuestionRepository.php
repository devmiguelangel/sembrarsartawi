<?php

namespace Sibas\Repositories\Client;

use Illuminate\Http\Request;
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
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}