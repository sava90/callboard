<?php

namespace Controller;

use Base\Controller;
use Service\User;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $userId = (int)$_GET['userId'];
        /** @var User $user */
        $user = User::getInstance();
        $this->viewData['user'] = $user->getUserData($userId);

        return $this->view('user/index');
    }
}