<?php

namespace Sibas\Entities\De;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\User;

class Header extends Model
{
    protected $table = 'op_de_headers';

    public $incrementing = false;

    protected $appends = [
        'completed',
        'certificate_number',
        'created_date',
        'days_from_creation',
    ];

    protected $casts = [
        'issued'           => 'boolean',
        'canceled'         => 'boolean',
        'facultative'      => 'boolean',
        'facultative_sent' => 'boolean',
        'approved'         => 'boolean',
    ];

    protected $fillable = [
        'facultative'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ad_user_id', 'id');
    }

    public function coverage()
    {
        return $this->belongsTo(Coverage::class, 'ad_coverage_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'op_de_header_id', 'id');
    }

    public function cancellation()
    {
        return $this->hasOne(Cancellation::class, 'op_de_header_id', 'id');
    }

    public function getCompletedAttribute()
    {
        $completed = true;

        foreach ($this->details as $detail) {
            if (!$detail->completed) {
                $completed = false;

                break;
            }
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

    public function getDaysFromCreationAttribute()
    {
        $date_now    = Carbon::now();
        $date_create = Carbon::createFromTimestamp(strtotime($this->created_at));

        return $date_now->diffInDays($date_create);
    }

}
