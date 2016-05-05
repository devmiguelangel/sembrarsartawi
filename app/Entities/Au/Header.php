<?php

namespace Sibas\Entities\Au;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\Client;
use Sibas\Entities\User;

class Header extends Model
{

    protected $table = 'op_au_headers';

    public $incrementing = false;

    protected $fillable = [
        'total_premium',
        'type',
        'issue_number',
        'prefix',
        'policy_number',
        'operation_number',
        'issued',
        'date_issue',
        'facultative',
        'facultative_observation',
        'facultative_sent',
        'share',
        'approved',
    ];

    protected $appends = [
        'full_year',
        'client_completed',
        'completed',
        'certificate_number',
        'created_date',
    ];

    protected $casts = [
        'warranty'         => 'boolean',
        'issued'           => 'boolean',
        'canceled'         => 'boolean',
        'facultative'      => 'boolean',
        'facultative_sent' => 'boolean',
        'approved'         => 'boolean',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'ad_user_id', 'id');
    }


    public function client()
    {
        return $this->belongsTo(Client::class, 'op_client_id', 'id');
    }


    public function details()
    {
        return $this->hasMany(Detail::class, 'op_au_header_id', 'id');
    }


    public function cancellation()
    {
        return $this->hasOne(Cancellation::class, 'op_au_header_id', 'id');
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


    public function getClientCompletedAttribute()
    {
        $completed = true;

        $client = $this->client;

        if (empty( $client->place_residence ) || empty( $client->locality ) || empty( $client->home_address ) || empty( $client->home_number ) || empty( $client->business_address )) {
            $completed = false;
        }

        return $completed;
    }


    public function getCompletedAttribute()
    {
        $completed = true;

        foreach ($this->details as $detail) {
            if ( ! $detail->completed) {
                $completed = false;

                break;
            }
        }

        if ( ! $this->client_completed) {
            $completed = false;
        }

        return $completed;
    }


    public function getCertificateNumberAttribute()
    {
        return $this->prefix . '-' . $this->issue_number;
    }


    public function getCreatedDateAttribute()
    {
        return Carbon::createFromTimestamp(strtotime($this->created_at))->format('d/m/Y H:i a');
    }

}
