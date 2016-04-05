<?php

namespace Sibas\Entities\Au;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\Client;

class Header extends Model
{

    protected $table = 'op_au_headers';

    public $incrementing = false;

    protected $fillable = [
        'total_premium',
    ];

    protected $appends = [
        'full_year',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class, 'op_client_id', 'id');
    }


    public function details()
    {
        return $this->hasMany(Detail::class, 'op_au_header_id', 'id');
    }


    public function getFullYearAttribute()
    {
        switch ($this->type_term) {
            case 'Y':
                return $this->term;
                break;
            case 'M':
                return round($this->term / 12, 0, PHP_ROUND_HALF_UP);
                break;
            case 'D':
                return round($this->term / 365, 0, PHP_ROUND_HALF_UP);
                break;
            default:
                return 0;
                break;
        }
    }

}
