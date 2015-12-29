<?php

namespace Sibas\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Sibas\Entities\User;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class MailController extends Controller
{
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
    protected $receiver;
    /**
     * @var null
     */
    private $attach;
    /**
     * @var array
     */
    protected $defaultSender = [
        'email' => 'info@sibas.com',
        'name'  => 'Sibas v2.0',
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
    private $template;

    public function __construct($template, array $sender = [], $subject, array $receiver, $attach = null)
    {
        $this->template = $template;
        $this->sender   = $sender;
        $this->subject  = $subject;
        $this->receiver = $receiver;
        $this->attach   = $attach;

        $this->setSenderAndReceiver();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function send(User $user)
    {
        Mail::send($this->template, ['user' => $user], function($message) use ($user)
        {
            $message->from($this->sender['email'], $this->sender['name']);

            $message->subject($this->subject);

            $message->to($this->receiver['email'], $this->receiver['name']);
        });

        return true;
    }

    protected function setSenderAndReceiver()
    {
        if (count($this->sender) != 2) {
            $this->sender = $this->defaultSender;
        }

        if (count($this->receiver) < 2) {
            $this->receiver = $this->defaultReceiver;
        }
    }
}
