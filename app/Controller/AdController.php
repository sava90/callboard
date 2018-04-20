<?php

namespace Controller;

use Base\Controller;
use Form\AdForm;
use Service\Ad;
use Service\User;

class AdController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $adId = (int)$_GET['adId'];
        /** @var Ad $ad */
        $ad = Ad::getInstance();

        /** @var User $user */
        $user = User::getInstance();
        $this->viewData['user'] = $user;

        $this->viewData['ad'] = $ad->getFullAdData($adId);

        return $this->view('ad/index');
    }

    public function addAction()
    {
        $this->redirectToLogin();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->insert($_POST);
        }

        $this->viewData['adForm'] = new AdForm();

        return $this->view('ad/add');
    }

    public function editAction()
    {
        $this->redirectToLogin();

        $adId = (int)$_GET['adId'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->update($_POST);
        }

        /** @var Ad $ad */
        $ad = Ad::getInstance();

        $this->viewData['ad'] = $ad->getAdData($adId);
        $this->viewData['adForm'] = new AdForm();

        return $this->view('ad/edit');
    }

    public function deleteAction()
    {
        $this->redirectToLogin();

        $adId = (int)$_GET['adId'];

        /** @var Ad $ad */
        $ad = Ad::getInstance();
        $ad->delete($adId);

        header('Location: /');
        exit;
    }

    private function insert($formData)
    {
        $this->redirectToLogin();

        if (!$this->isRequestAjax()) {
            exit;
        }

        /** @var Ad $ad */
        $ad = Ad::getInstance();
        $result = $ad->insert($formData);
        echo json_encode($result);

        return;
    }

    private function update($formData)
    {
        $this->redirectToLogin();

        if (!$this->isRequestAjax()) {
            exit;
        }

        /** @var Ad $ad */
        $ad = Ad::getInstance();
        $result = $ad->update($formData);
        echo json_encode($result);

        return;
    }
}