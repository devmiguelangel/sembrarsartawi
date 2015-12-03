<?php

namespace Sibas\Entities\Vi;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model {

    protected $table = 'op_vi_details';
    public $incrementing = false;

    public function client() {
        return $this->belongsTo('Sibas\Entities\Client', 'op_client_id', 'id');
    }

    public function header() {
        return $this->belongsTo('Sibas\Entities\Vi\Header', 'op_vi_header_id', 'id');
    }
    

}
