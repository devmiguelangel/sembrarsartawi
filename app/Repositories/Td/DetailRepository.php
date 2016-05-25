<?php

namespace Sibas\Repositories\Td;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Td\Detail;
use Sibas\Entities\Td\Header;
use Sibas\Repositories\BaseRepository;

class DetailRepository extends BaseRepository
{
 /**
     * Create a newly created Detail.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function createDetail($request)
    {
        $this->data = $request->all();
        if ($this->getDetailById($this->data['id_detail'])) {
            return $this->updateDetail($this->model);
        }
        return $this->storeDetail($request);
    }
    
    public function updateRate($request, $rate){
        $this->data = $request;
        $this->rate_final = $rate;
        if ($this->getDetailById($this->data['id'])) {
            if ($this->model instanceof Detail) {
                $this->setDataRate();
                return $this->saveModel();
            }
        }
        return false;
    }


    /**
     * Detail store.
     *
     * @param Request $request
     *
     * @return bool
     */
    private function storeDetail($request)
    {
        $this->model = new Detail();
        $this->model->id = date('U');

        $this->setData();
        //edw-->dd($this->model);

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
    private function updateDetail($detail = null) {
        if ($detail instanceof Detail) {
            $this->model = $detail;
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
    private function setData() {
        $this->model->matter_insured        = $this->data['matter_insured'];
        $this->model->matter_description    = $this->data['matter_description'];
        $this->model->number                = $this->data['number'];
        $this->model->use                   = $this->data['use'];
        $this->model->construction_value    = $this->data['construction_value'];
        $this->model->land_value            = $this->data['land_value'];
        $this->model->city                  = $this->data['city'];
        $this->model->zone                  = $this->data['zone'];
        $this->model->locality              = $this->data['locality'];
        $this->model->address               = $this->data['address'];
        $this->model->op_td_header_id       = $this->data['id_header'];
        
        if ($this->data['matter_insured'] == 'PR')
            $this->model->insured_value = ($this->data['construction_value'] + $this->data['land_value']);
        else
            $this->model->insured_value = $this->data['insured_value'];
    }
    /**
     * actualiza prima en base a la tasa
     */
    private function setDataRate() {
        $this->model->rate        = $this->rate_final;
        $this->model->premium     = ($this->data['insured_value']*$this->rate_final)/100;
    }

    /** Find Client by dni and extension
     *
     * @param      $dni
     * @param null $extension
     *
     * @return bool
     */
    public function getDetailById($id) {
        $query = Detail::where('id', '=', $id);
        $this->model = $query->get();

        if ($this->model->count() == 1) {
            $this->model = $this->model->first();

            return true;
        }
        return false;
    }
    /**
     * funcion retorna registros mediante id de hader
     * @param type $idHeader
     * @return boolean
     */
    public function getDetailByHeader($idHeader) {
        $query = Detail::where('op_td_header_id', '=', $idHeader);
        $this->model = $query->get();

        if ($this->model->count() == 1) {
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