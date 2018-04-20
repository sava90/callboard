<?php

namespace Controller;

use Base\Controller;
use Service\Ad;
use Service\User;

class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        /** @var Ad $ad */
        $ad = Ad::getInstance();
        $this->viewData['ads'] = $ad->getAds();

        /** @var User $user */
        $user = User::getInstance();
        $this->viewData['user'] = $user;

        return $this->view('main/index');
    }
}