<?php

namespace Sibas\Repositories\Client;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Client;
use Sibas\Entities\User;
use Sibas\Repositories\BaseRepository;

class ClientRepository extends BaseRepository
{
    /**
     * @var Client
     */
    private $client;

    private $id;

    private $errors;

    private $data;

    private $header;

    public function getId()
    {
        return $this->id;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function saveClient($request)
    {
        $this->data = $request->all();

        $this->header = $this->data['header'];

        try {
            if ($this->header->type === 'Q') {
                if ($this->getClientByDni($this->data['dni'], $this->data['extension'])) {
                    return $this->updateClient();
                }

                return $this->storeClient($request);
            } elseif ($this->data['header']->type === 'I') {

            }
        } catch(QueryException $e) {
            $this->errors = $e->getMessage();
        }
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function storeClient($request)
    {
        /** @var User $user */
        $user = $request->user()->with('retailer')->first();

        $retailer = $user->retailer->first();

        $this->client = new Client();

        $this->id = date('U');

        $this->client->id             = $this->id;
        $this->client->ad_retailer_id = $retailer->id;
        $this->client->dni            = $this->data['dni'];
        $this->client->extension      = $this->data['extension'];

        $this->setData();

        if ($this->client->save()) {
            return true;
        }
    }

    /**
     * @param Request $request
     * @param String $client_id
     * @return bool
     */
    public function putClient($request, $client_id)
    {
        $this->data = $request->all();
        $client_id  = decode($client_id);

        try {
            return $this->updateClient($client_id);
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

    private function updateClient($id = null)
    {
        if (! is_null($id)) {
            $this->getClientById($id);
        }

        $this->setData();

        if ($this->client->save()) {
            $this->id = $this->client->id;

            return true;
        }
    }

    private function setData()
    {
        $this->carbon = new Carbon();
        $date = $this->carbon->createFromTimestamp(strtotime($this->data['birthdate']));

        $this->client->type           = 'N';
        $this->client->first_name     = $this->data['first_name'];
        $this->client->last_name      = $this->data['last_name'];
        $this->client->mother_last_name = $this->data['mother_last_name'];
        $this->client->married_name   = $this->data['married_name'];
        $this->client->birthdate      = $date->format('Y-m-d');
        $this->client->age            = $date->age;
        $this->client->birth_place    = $this->data['birth_place'];
        $this->client->complement     = $this->data['complement'];
        $this->client->document_type  = $this->data['document_type'];
        $this->client->civil_status   = $this->data['civil_status'];
        $this->client->gender         = $this->data['gender'];
        $this->client->place_residence = $this->data['place_residence'];
        $this->client->locality       = $this->data['locality'];
        $this->client->home_address   = $this->data['home_address'];
        $this->client->country        = $this->data['country'];
        $this->client->ad_activity_id = $this->data['ad_activity_id'];
        $this->client->occupation_description = $this->data['occupation_description'];
        $this->client->phone_number_home      = $this->data['phone_number_home'];
        $this->client->phone_number_office    = $this->data['phone_number_office'];
        $this->client->phone_number_mobile    = $this->data['phone_number_mobile'];
        $this->client->email          = $this->data['email'];
        $this->client->weight         = $this->data['weight'];
        $this->client->height         = $this->data['height'];
    }

    public function getClientByDni($dni, $extension = null)
    {
        $query = Client::select('id', 'dni', 'extension')
            ->where('dni', '=', $dni);

        if (! is_null($extension)) {
            $query->where('extension', '=', $extension);
        }

        $this->client = $query->get();

        if ($this->client->count() === 1) {
            $this->client = $this->client->first();

            return true;
        }

        return false;
    }

    public function getClientById($client_id)
    {
        $this->client = Client::where('id', '=', $client_id)->get();

        if ($this->client->count() === 1) {
            $this->client = $this->client->first();

            return true;
        }

        return false;
    }

}