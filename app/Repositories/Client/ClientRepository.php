<?php

namespace Sibas\Repositories\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Sibas\Entities\Client;
use Sibas\Repositories\BaseRepository;

class ClientRepository extends BaseRepository
{

    /**
     * Create a newly created Client.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function createClient($request)
    {
        $this->data = $request->all();

        if ($this->getClientByDni($this->data['dni'], $this->data['extension'])) {
            return $this->updateClient($this->model);
        }

        return $this->storeClient($request);
    }


    /**
     * Client store.
     *
     * @param Request $request
     *
     * @return bool
     */
    private function storeClient($request)
    {
        $retailer = $request->user()->retailer->first();

        $this->model = new Client();

        $this->model->id             = date('U');
        $this->model->ad_retailer_id = $retailer->id;
        $this->model->dni            = $this->data['dni'];
        $this->model->extension      = $this->data['extension'];

        $this->setData();

        return $this->saveModel();
    }


    /**
     * Client edit
     *
     * @param Request $request
     * @param         $client
     *
     * @return bool
     */
    public function editClient($request, $client)
    {
        $this->data = $request->all();

        return $this->updateClient($client);
    }


    /** Update Client
     *
     * @param null $client
     *
     * @return bool
     */
    private function updateClient($client = null)
    {
        if ($client instanceof Client) {
            $this->model = $client;

            $this->setData();

            return $this->saveModel();
        }

        return false;
    }


    /** Set complementary data on Issue
     *
     * @param Request      $request
     * @param Model|Client $client
     *
     * @return bool
     */
    public function updateIssueClient($request, $client)
    {
        $this->data  = $request->all();
        $this->model = $client;

        $this->data['document_type'] = $this->model->document_type;
        $this->data['complement']    = $this->model->complement;
        $this->data['gender']        = $this->model->gender;
        $this->data['weight']        = $this->model->weight;
        $this->data['height']        = $this->model->height;

        $this->setData();

        if (key_exists('hand', $this->data)) {
            $this->model->hand = $this->data['hand'];
        }

        if (key_exists('avenue_street', $this->data)) {
            $this->model->avenue_street = $this->data['avenue_street'];
        }

        $this->model->home_number      = $this->data['home_number'];
        $this->model->business_address = $this->data['business_address'];

        return $this->saveModel();
    }


    /** Set data to Client
     *
     */
    private function setData()
    {
        $date = $this->carbon->createFromTimestamp(strtotime(str_replace('/', '-', $this->data['birthdate'])));

        if (key_exists('code', $this->data)) {
            $this->model->code = $this->data['code'];
        }

        $this->model->type                   = 'N';
        $this->model->first_name             = $this->data['first_name'];
        $this->model->last_name              = $this->data['last_name'];
        $this->model->mother_last_name       = $this->data['mother_last_name'];
        $this->model->married_name           = $this->data['married_name'];
        $this->model->birthdate              = $date->format('Y-m-d');
        $this->model->age                    = $date->age;
        $this->model->complement             = $this->data['complement'];
        $this->model->gender                 = $this->data['gender'];
        $this->model->ad_activity_id         = $this->data['ad_activity_id'];
        $this->model->occupation_description = $this->data['occupation_description'];
        $this->model->phone_number_home      = $this->data['phone_number_home'];
        $this->model->phone_number_mobile    = $this->data['phone_number_mobile'];
        $this->model->email                  = $this->data['email'];

        if (key_exists('birth_place', $this->data)) {
            $this->model->birth_place = $this->data['birth_place'];
        }

        if (key_exists('document_type', $this->data)) {
            $this->model->document_type = $this->data['document_type'];
        }

        if (key_exists('civil_status', $this->data)) {
            $this->model->civil_status = $this->data['civil_status'];
        }

        if (key_exists('place_residence', $this->data)) {
            $this->model->place_residence = $this->data['place_residence'];
        }

        if (key_exists('locality', $this->data)) {
            $this->model->locality = $this->data['locality'];
        }

        if (key_exists('home_address', $this->data)) {
            $this->model->home_address = $this->data['home_address'];
        }

        if (key_exists('country', $this->data)) {
            $this->model->country = $this->data['country'];
        }

        if (key_exists('phone_number_office', $this->data)) {
            $this->model->phone_number_office = $this->data['phone_number_office'];
        }

        if (key_exists('weight', $this->data)) {
            $this->model->weight = $this->data['weight'];
        }

        if (key_exists('height', $this->data)) {
            $this->model->height = $this->data['height'];
        }
    }


    /** Find Client by dni and extension
     *
     * @param      $dni
     * @param null $extension
     *
     * @return bool
     */
    public function getClientByDni($dni, $extension = null)
    {
        $query = Client::where('dni', '=', $dni);

        if ( ! is_null($extension)) {
            $query->where('extension', '=', $extension);
        }

        $this->model = $query->get();

        if ($this->model->count() === 1) {
            $this->model = $this->model->first();

            return true;
        }

        return false;
    }


    /** Find Client by Id
     *
     * @param $client_id
     *
     * @return bool
     */
    public function getClientById($client_id)
    {
        $this->model = Client::where('id', '=', $client_id)->get();

        if ($this->model->count() === 1) {
            $this->model = $this->model->first();

            return true;
        }

        return false;
    }

}