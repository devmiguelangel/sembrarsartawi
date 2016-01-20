<?php

namespace Sibas\Entities\Mc;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'mc_certificates';

    public function certificateQuestionnaires()
    {
        return $this->hasMany(CertificateQuestionnaire::class, 'mc_certificate_id', 'id');
    }
}
