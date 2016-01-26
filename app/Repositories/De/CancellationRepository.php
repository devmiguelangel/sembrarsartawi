<?php

namespace Sibas\Repositories\De;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Sibas\Entities\De\Header;
use Sibas\Repositories\BaseRepository;

class CancellationRepository extends BaseRepository
{
    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getHeaderList(Request $request)
    {
        $headers = Header::with('details.client', 'user.city', 'user.agency')
            ->where('issued', true)
            ->where('canceled', false);

        if ($request->has('policy_number')) {
            $headers = $headers->where('issue_number', 'like', '%' . $request->get('policy_number') . '%');
        }

        if ($request->has('city')) {
            $headers = $headers->whereHas('user.city', function ($q) use ($request) {
                $q->where('slug', $request->get('city'));
            });
        }

        if ($request->has('agency')) {
            $headers = $headers->whereHas('user.agency', function ($q) use ($request) {
                $q->where('slug', $request->get('agency'));
            });
        }

        if ($request->has('username')) {
            $headers = $headers->whereHas('user', function ($q) use ($request) {
                $q->where('username', $request->get('username'));
            });
        }

        if ($request->has('client')) {
            $headers = $headers->whereHas('details.client', function ($q) use ($request) {
                $q->where(function($q1) use ($request) {
                    $q1->orWhere('first_name', 'like', '%' . $request->get('client') . '%')
                        ->orWhere('last_name', 'like', '%' . $request->get('client') . '%')
                        ->orWhere('mother_last_name', 'like', '%' . $request->get('client') . '%');
                });
            });
        }

        if ($request->has('dni')) {
            $headers = $headers->whereHas('details.client', function ($q) use ($request) {
                $q->where('dni', 'like', '%' . $request->get('dni') . '%');
            });
        }

        if ($request->has('extension')) {
            $headers = $headers->whereHas('details.client', function ($q) use ($request) {
                $q->where('extension', 'like', '%' . $request->get('extension') . '%');
            });
        }

        if ($request->has('date_begin') && $request->has('date_end')) {
            $date_begin = $this->carbon->createFromTimestamp(strtotime(str_replace('/', '-', $request->get('date_begin'))));
            $date_end   = $this->carbon->createFromTimestamp(strtotime(str_replace('/', '-', $request->get('date_end'))));

            $headers = $headers->whereBetween('date_issue', [$date_begin, $date_end]);
        }

        return $headers->get();
    }

    /**
     * @param Request $request
     * @param Model $header
     * @return bool
     */
    public function storeCancellation(Request $request, $header)
    {
        $user        = $request->user();
        $this->data  = $request->all();
        $this->model = $header;

        $this->model->cancellation()->create([
            'id'         => date('U'),
            'ad_user_id' => $user->id,
            'reason'     => $this->data['reason']
        ]);

        $this->model->canceled = true;

        return $this->saveModel();
    }
}