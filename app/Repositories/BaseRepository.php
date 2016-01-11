<?php

namespace Sibas\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Sibas\Collections\BaseCollection;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;
    /**
     * @var BaseCollection
     */
    private $collection;
    /**
     * @var Collection
     */
    private $selectOption;
    /**
     * @var Carbon
     */
    protected $carbon;

    protected $errors;

    protected $data;
    /**
     * @var array
     */
    protected $fieldName;
    /**
     * @var string
     */
    protected $reasonImc;
    /**
     * @var string
     */
    protected $reasonResponse;
    /**
     * @var string
     */
    protected $reasonCumulus;
    /**
     * @var array
     */
    protected $records;

    public function __construct()
    {
        $this->collection   = new BaseCollection();
        $this->selectOption = $this->collection->selectOption();
        $this->carbon       = new Carbon();
        $this->response     = false;

        $this->reasonImc      = 'El Titular :name no cumple con el IMC. ';
        $this->reasonResponse = 'El Titular :name no cumple con el Cuestionario de Salud. ';
        $this->reasonCumulus  = 'El monto total acumulado del Titular :name es :cumulus Bs. y supera el monto maximo '
                                . 'permitido. Monto maximo permitido :amount_max Bs. ';

        $this->fieldName = [
            'Q' => 'quote_number',
            'I' => 'issue_number',
        ];

        $this->records = [
            'all'             => [],
            'all-unread'      => [],
            'approved'        => [],
            'approved-unread' => [],
            'observed'        => [],
            'observed-unread' => [],
            'rejected'        => [],
            'rejected-unread' => [],
        ];
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /** Save Model
     *
     * @return bool
     */
    public function saveModel()
    {
        try {
            if ($this->model->save()) {
                return true;
            }
        } catch(QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

    protected function getSelectOption()
    {
        return $this->selectOption;
    }

    /** Returns a data forms select
     * @param array $data
     * @return Collection
     */
    protected function getData($data)
    {
        $d = [];

        foreach ($data as $key => $value) {
            $d[] = [
                'id'   => $key,
                'name' => $value
            ];
        }

        return $this->selectOption->merge($d);
    }

    /**
     * @param $header_id
     * @param $clients
     * @return bool
     */
    public function setClientCacheSP($header_id, $clients)
    {
        $clients = json_encode($clients);
        $key     = 'clients_' . $header_id;

        Cache::put($key, $clients, 60);
    }

    public function destroyClientCacheSP($header_id, $detail_id)
    {
        $key = 'clients_' . $header_id;

        if (Cache::has($key)) {
            $clients = Cache::pull($key);

            if (! is_null($clients)) {
                $clients = json_decode($clients, true);
                $client  = array_shift($clients);

                if ($client === $detail_id) {
                    $this->setClientCacheSP($header_id, $clients);
                }

                if (count($clients) > 0) {
                    return true;
                }
            }

        }

        return false;
    }

    public function getAmountInBs($currency, $amount, $bs_value)
    {
        switch ($currency) {
            case 'USD':
                $amount = $amount * $bs_value;
                break;
        }

        return $amount;
    }

    public function getEvaluationResponse($response)
    {
        $questions = json_decode($response->response, true);

        foreach ($questions as $question) {
            if ($question['expected'] != $question['response']) {
                return true;
            }
        }

        return false;
    }
}