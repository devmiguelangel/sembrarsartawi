<?php

namespace Sibas\Entities\Mc;

use Illuminate\Database\Eloquent\Model;

class CertificateQuestionnaire extends Model
{
    protected $table = 'mc_certificate_questionnaires';

    protected $appends = [
        'module',
    ];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class, 'mc_questionnaire_id', 'id');
    }

    public function questions()
    {
        return $this->belongsToMany(McQuestion::class,
            'mc_certificate_questionnaire_questions',
            'mc_certificate_questionnaire_id',
            'mc_question_id')
            ->wherePivot('active', true);
    }

    public function getModuleAttribute()
    {
        $total = $this->questions->count();
        $res   = $total / 3;

        if ($res > 1) {
            return 0;
        }

        return ($total % 3);
    }
}
