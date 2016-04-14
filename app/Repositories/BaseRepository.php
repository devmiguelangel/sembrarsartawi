<?php

namespace Sibas\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Sibas\Collections\BaseCollection;
use Sibas\Entities\Client;
use Sibas\Http\Controllers\MailController;

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
     * @var string
     */
    protected $reasonYear;

    /**
     * @var string
     */
    protected $reasonAmount;

    /**
     * @var Collection
     */
    protected $records;

    /**
     * @var Model
     */
    protected $fa;

    /**
     * @var Model
     */
    protected $header;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var int
     */
    public $approved = null;


    public function __construct()
    {
        $this->collection   = new BaseCollection();
        $this->selectOption = $this->collection->selectOption();
        $this->carbon       = new Carbon();
        $this->response     = false;

        $this->reasonImc      = 'El Titular :name no cumple con el IMC. ';
        $this->reasonResponse = 'El Titular :name no cumple con el Cuestionario de Salud. ';
        $this->reasonCumulus  = 'El monto total acumulado del Titular :name es :cumulus Bs. y supera el monto maximo ' . 'permitido. Monto maximo permitido :amount_max Bs. ';
        $this->reasonYear     = 'El Vehículo con placa :license_plate tiene una antiguedad mayor a :year_max años. ';
        $this->reasonAmount   = 'El valor asegurado del Vehículo con placa :license_plate excede el máximo valor permitido. Valor permitido: :amount_max USD. ';

        $this->fieldName = [
            'Q' => 'quote_number',
            'I' => 'issue_number',
            'P' => 'policy_number',
        ];

        $this->records = collect([
            'all'             => collect(),
            'all-unread'      => collect(),
            'approved'        => collect(),
            'approved-unread' => collect(),
            'observed'        => collect(),
            'observed-unread' => collect(),
            'rejected'        => collect(),
            'rejected-unread' => collect(),
        ]);
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
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }


    /** Get next number (Quote - Issue)
     *
     * @param string $field
     *
     * @param int    $default
     *
     * @return int
     */
    public function getNumber($field, $default = 1)
    {
        $max = $this->model->max($this->fieldName[$field]);

        return is_null($max) ? $default : $max + 1;
    }


    /** Verifies registration number (Quote - Issue)
     *
     * @param string $field
     * @param int    $number
     *
     * @return bool
     */
    public function checkNumber($field, $number)
    {
        return $this->model->where($this->fieldName[$field], $number)->exists();
    }


    protected function getSelectOption()
    {
        return $this->selectOption;
    }


    /** Returns a data forms select
     *
     * @param array $data
     *
     * @return Collection
     */
    protected function getData($data)
    {
        $d = [ ];

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
     *
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

            if ( ! is_null($clients)) {
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


    /**
     * @param MailController $mail
     * @param string         $rp_id
     * @param bool           $response
     *
     * @return bool
     */
    public function sendMail(MailController $mail, $rp_id, $response = false)
    {
        $profiles = '';
        $process  = '';
        $subject  = ':process : Respuesta :response a Caso Facultativo No. ' . $this->header->prefix . '-' . $this->header->issue_number . ' ' . $this->client->full_name;

        $template = 'de.facultative.';

        switch ($this->approved) {
            case 1:
                $process = 'Aprobado';
                $template .= 'process';
                break;
            case 0:
                $process = 'Rechazado';
                $template .= 'process';
                break;
            case 2:
                $process = $this->fa->observations->last()->state->state;

                if ($response) {
                    $template .= 'response';
                    $subject = str_replace(':response', 'del Oficial de Credito', $subject);
                } else {
                    $template .= 'observation';
                }
                break;
        }

        $subject = str_replace(':response', 'de la aseguradora', $subject);
        $subject = str_replace(':process', $process, $subject);

        $mail->subject  = $subject;
        $mail->template = $template;

        if ($this->approved >= 0 && ! $response) {
            array_push($mail->receivers, [
                'email' => $this->header->user->email,
                'name'  => $this->header->user->full_name,
            ]);
        } elseif ($response) {
            array_push($mail->receivers, [
                'email' => $this->fa->observations->last()->user->email,
                'name'  => $this->fa->observations->last()->user->full_name,
            ]);
        }

        $fa     = $this->fa;
        $client = $this->client;

        if ($mail->send(decode($rp_id), compact('fa', 'client'), $profiles)) {
            return true;
        }

        return false;
    }

}