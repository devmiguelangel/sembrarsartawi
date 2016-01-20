<?php

namespace Sibas\Repositories\De;

use Illuminate\Http\Request;
use Sibas\Entities\Mc\Answer;
use Sibas\Entities\Mc\Certificate;
use Sibas\Repositories\BaseRepository;

class MedicalCertificateRepository extends BaseRepository
{
    /**
     * Get Medical Certificate by Product
     * @param $rp_id
     * @return bool
     */
    public function getMedicalCertificateByProduct($rp_id)
    {
        $this->model = Certificate::with([
            'certificateQuestionnaires.questionnaire',
            'certificateQuestionnaires.questions'
        ])
            ->whereHas('certificateQuestionnaires', function ($query) {
                $query->where('active', true);
            })
            ->where('ad_retailer_product_id', $rp_id)
            ->where('active', true)->first();

        // dd($this->model);

        if ($this->model instanceof Certificate) {
            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function storeMedicalCertificate(Request $request)
    {
        $user       = $request->user();
        $this->data = $request->all();

        $this->model = new Answer([
            'id'                         => date('U'),
            'medical_certificate_number' => rand(10, 1000),
            'ad_user_id'                 => $user->id,
            'mc_certificate_id'          => decode($this->data['mcid']),
            'center_attention'           => $this->data['center_attention'],
            'contact_person'             => $this->data['contact_person'],
            'response'                   => json_encode($this->data['answers']),
        ]);

        return $this->saveModel();
    }
}