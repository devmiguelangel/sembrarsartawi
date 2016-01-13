<?php

namespace Sibas\Entities\De;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\User;

class Header extends Model
{
    protected $table = 'op_de_headers';

    public $incrementing = false;

    protected $casts = [
        'facultative' => 'boolean',
        'approved'    => 'boolean',
    ];

    protected $appends = [
        'certificate_number',
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
        return $this->hasOne(Coverage::class, 'id', 'ad_coverage_id');
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'op_de_header_id', 'id');
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

}
