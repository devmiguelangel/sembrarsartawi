<?php

namespace Sibas\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Sibas\Entities\RetailerProduct;
use Sibas\Entities\User;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\UserRepository;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class MailController extends Controller
{
    /**
     * @var User
     */
    protected $user;
    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var string
     */
    public $subject = null;
    /**
     * @var array
     */
    public $sender;
    /**
     * @var array
     */
    public $receivers;
    /**
     * @var Collection
     */
    protected $emails;
    /**
     * @var null
     */
    public $attach = null;
    /**
     * @var array
     */
    protected $defaultSender;
    /**
     * @var string
     */
    public $template = '';
    /**
     * @var string
     */
    protected $html;

    public function __construct(User $user)
    {
        $this->user           = $user;
        $this->userRepository = new UserRepository();
        $this->sender         = [];
        $this->receivers      = [];
        $this->emails         = [];

        $this->defaultSender = [
            'email' => 'emontano@sudseguros.com',
            'name'  => 'Ernesto Montaño'
        ];
    }

    /**
     * @param $rp_id
     * @param array $data
     * @param array|string $profiles
     * @return bool
     */
    public function send($rp_id, array $data = [], $profiles = [])
    {
        $this->setSender();
        $this->setReceivers($profiles);
        $this->emailsByProduct($rp_id);

        $user = $this->user;

        $this->setHtml($data);

        Mail::send('emails.layout', ['html' => $this->html], function($message) use ($user)
        {
            $message->from($this->sender['email'], $this->sender['name']);
            $message->subject($this->sender['name'] . '. ' . $this->subject);

            foreach ($this->receivers as $key => $receiver) {
                $message->to($receiver['email'], $receiver['name']);
            }

            foreach ($this->emails as $email) {
                $message->cc($email->email, $email->name);
            }
        });

        if (count(Mail::failures()) > 0) {
            //dd(Mail::failures);

            return false;
        }

        return true;
    }

    protected function setSender()
    {
        if (empty($this->sender)) {
            $this->sender         = $this->defaultSender;
            $this->sender['name'] = $this->user->retailer->first()->name;
        }
    }

    /**
     * @param array|string $profiles
     */
    protected function setReceivers($profiles)
    {
        if (! empty($profiles)) {
            if (is_string($profiles)) {
                $profiles = [ $profiles ];
            }

            $users = $this->userRepository->getUserByProfile($this->user, $profiles);

            foreach ($users as $user) {
                array_push($this->receivers, [
                    'email' => $user->email,
                    'name'  => $user->full_name,
                ]);
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

        $this->user->name = $this->user->full_name;

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
