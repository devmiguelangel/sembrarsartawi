<?php

namespace Sibas\Entities\Mc;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\User;

class Answer extends Model
{

    protected $table = 'op_mc_answers';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'medical_certificate_number',
        'ad_user_id',
        'mc_certificate_id',
        'center_attention',
        'contact_person',
        'response',
    ];

    protected $appends = [
        'creation_date',
    ];


    public function getCreationDateAttribute()
    {
        $time = Carbon::createFromTimestamp(strtotime($this->created_at));

        return $time->day . ' de ' . monthES($time->month) . ' de ' . $time->year;
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'ad_user_id', 'id');
    }

}
