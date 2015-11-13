<?php

namespace Sibas\Repositories\Client;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Client;
use Sibas\Entities\User;
use Sibas\Repositories\BaseRepository;

class ClientRepository extends BaseRepository
{

    /**
     * @param Request $request
     * @return bool
     */
    public function saveClientQuote($request)
    {
        /** @var User $user */
        $user = $request->user()->with('retailer')->first();

        $retailer = $user->retailer->first();

        $data = $request->all();

        try {
            $date = $this->carbon->createFromTimestamp(strtotime($data['birthdate']));

            $client = new Client();

            $client->id             = date('U');
            $client->ad_retailer_id = $retailer->id;
            $client->type           = 'N';
            $client->first_name     = $data['first_name'];
            $client->last_name      = $data['last_name'];
            $client->mother_last_name = $data['mother_last_name'];
            $client->married_name   = $data['married_name'];
            $client->birthdate      = $date->format('Y-m-d');
            $client->age            = $date->age;
            $client->birth_place    = $data['birth_place'];
            $client->dni            = $data['dni'];
            $client->extension      = $data['extension'];
            $client->complement     = $data['complement'];
            $client->document_type  = $data['document_type'];
            $client->civil_status   = $data['civil_status'];
            $client->gender         = $data['gender'];
            $client->place_residence = $data['place_residence'];
            $client->locality       = $data['locality'];
            $client->home_address   = $data['home_address'];
            $client->country        = $data['country'];
            $client->ad_activity_id = $data['ad_activity_id'];
            $client->occupation_description = $data['occupation_description'];
            $client->phone_number_home      = $data['phone_number_home'];
            $client->phone_number_office    = $data['phone_number_office'];
            $client->phone_number_mobile    = $data['phone_number_mobile'];
            $client->email          = $data['email'];
            $client->weight         = $data['weight'];
            $client->height         = $data['height'];

            if ($client->save()) {
                return true;
            }

        } catch(QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }
}