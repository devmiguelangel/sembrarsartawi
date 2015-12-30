<?php

namespace Sibas\Entities\Vi;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\Client;

class Detail extends Model {

    protected $table = 'op_vi_details';
    public $incrementing = false;

    public function client() {
        return $this->belongsTo(Client::class, 'op_client_id', 'id');
    }

    public function header() {
        return $this->belongsTo(Header::class, 'op_vi_header_id', 'id');
    }

}
