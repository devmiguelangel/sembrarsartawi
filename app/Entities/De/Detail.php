<?php

namespace Sibas\Entities\De;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\Client;

class Detail extends Model
{

    protected $table = 'op_de_details';

    public $incrementing = false;

    protected $fillable = [
        'approved',
        'rejected',
    ];

    protected $appends = [
        'completed',
        'list_beneficiaries',
    ];

    protected $casts = [
        'approved' => 'boolean'
    ];


    public function header()
    {
        return $this->belongsTo(Header::class, 'op_de_header_id', 'id');
    }


    public function client()
    {
        return $this->belongsTo(Client::class, 'op_client_id', 'id');
    }


    public function response()
    {
        return $this->hasOne(Response::class, 'op_de_detail_id', 'id');
    }


    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class, 'op_de_detail_id', 'id');
    }


    public function facultative()
    {
        return $this->hasOne(Facultative::class, 'op_de_detail_id', 'id');
    }


    public function getCompletedAttribute()
    {
        foreach ($this->list_beneficiaries as $beneficiary) {
            if (is_null($beneficiary)) {
                return false;
            }
        }

        return true;
    }


    public function getListBeneficiariesAttribute()
    {
        return [
            'SP' => $this->beneficiaries()->where('coverage', 'SP')->first(),
            'VI' => $this->beneficiaries()->where('coverage', 'VI')->first(),
            'CO' => $this->beneficiaries()->where('coverage', 'CO')->first(),
        ];
    }

}
