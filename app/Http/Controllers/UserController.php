<?php

namespace Sibas\Http\Controllers;

use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

}
