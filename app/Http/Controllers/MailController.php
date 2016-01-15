<?php

namespace Sibas\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Sibas\Entities\RetailerProduct;
use Sibas\Entities\User;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class MailController extends Controller
{
    /**
     * @var User
     */
    protected $user;
    /**
     * @var array
     */
    protected $sender;
    /**
     * @var string
     */
    protected $subject;
    /**
     * @var array
     */
    protected $receivers;
    /**
     * @var null
     */
    protected $attach;
    /**
     * @var array
     */
    protected $defaultSender = [
        'email' => 'emontano@sudseguros.com',
        'name'  => 'Ernesto Montaño',
    ];
    /**
     * @var array
     */
    protected $defaultReceiver = [
        'email' => 'djmiguelarango@outlook.com',
        'name'  => 'Miguel Angel',
    ];
    /**
     * @var string
     */
    protected $template;
    /**
     * @var string
     */
    protected $html;
    /**
     * @var Collection
     */
    protected $emails;

    public function __construct(User $user, $template, array $sender = [], $subject, array $receivers, $attach = null)
    {
        $this->user      = $user;
        $this->template  = $template;
        $this->sender    = $sender;
        $this->subject   = $subject;
        $this->receivers = $receivers;
        $this->attach    = $attach;
        $this->emails    = [];

        $this->setSenderAndReceiver();
    }

    /**
     * @param $rp_id
     * @param array $data
     * @return bool
     */
    public function send($rp_id, array $data = [])
    {
        $this->emailsByProduct($rp_id);

        $this->user->name = $this->user->full_name;
        $user             = $this->user;

        $this->setHtml($data);

        Mail::send('emails.layout', ['html' => $this->html], function($message) use ($user)
        {
            $message->from($this->sender['email'], $this->sender['name']);

            $message->subject($this->sender['name'] . '. ' . $this->subject);

            foreach ($this->receivers as $key => $receiver) {
                if (is_array($receiver)) {
                    $message->to($receiver['email'], $receiver['name']);
                } elseif ($key === 'email') {
                    $message->to($this->receivers['email'], $this->receivers['name']);
                }
            }

            foreach ($this->emails as $email) {
                $message->cc($email->email, $email->name);
            }
        });

        return true;
    }

    protected function setSenderAndReceiver()
    {
        if (count($this->sender) != 2) {
            $this->sender         = $this->defaultSender;
            $this->sender['name'] = $this->user->retailer->first()->name;
        }

        if (count($this->receivers) < 2) {
            foreach ($this->receivers as $receiver) {
                if (! is_array($receiver)) {
                    $this->receivers = $this->defaultReceiver;

                    break;
                }
            }
        }
    }

    /**
     * @param $rp_id
     */
    protected function emailsByProduct($rp_id)
    {
        $retailerProduct = $this->user->retailer()->first()
            ->retailerProducts()->where('id', $rp_id)->first();

        if ($retailerProduct instanceof RetailerProduct) {
            $this->emails = $retailerProduct->emails;
        }

        $this->emails->push($this->user);
    }

    /**
     * @param array $data
     * @throws \TijsVerkoyen\CssToInlineStyles\Exception
     */
    protected function setHtml(array $data)
    {
        $html = view('emails.' . $this->template, [
            'user' => $this->user,
            'data' => $data
        ])->render();

        $css = file_get_contents(asset('assets/css/bootstrap.css'));

        $cssToInlineStyles = new CssToInlineStyles();
        $cssToInlineStyles->setHTML($html);
        $cssToInlineStyles->setCSS($css);

        $this->html = $cssToInlineStyles->convert();
    }
}
