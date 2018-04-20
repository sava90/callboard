<?php

namespace Service;

use Form\AdForm;
use Model\AdModel;
use Text;
use Base\Service;

class Ad extends Service
{
    protected function __construct()
    {
        $this->model = new AdModel();
    }

    public function getAdData($adId)
    {
        return $this->model->getAdData($adId);
    }

    public function getFullAdData($adId)
    {
        return $this->model->getFullAdData($adId);
    }

    public function getAds()
    {
        return $this->model->getAds();
    }

    public function insert(array $formData = [])
    {
        $adAddForm = new AdForm($formData);

        if (!$adAddForm->isValid()) {
            return $adAddForm->getErrors();
        }

        /** @var User $user */
        $user = User::getInstance();

        $title = $formData[$adAddForm->getName().'_title'];
        $text = strip_tags($formData[$adAddForm->getName().'_text']);

        $lastInsertId = $this->model->insert($user->userId, $title, $text);

        if (!$lastInsertId) {
            $adAddForm->setError($adAddForm->getName().'_result', false, Text::$error);

            return $adAddForm->getErrors();
        }

        /** @var File $file */
        $file = File::getInstance();
        $fileName = $file->uploadFile($_FILES[$adAddForm->getName().'_image'], $lastInsertId);

        if ($fileName) {
            $this->model->updateFileName($lastInsertId, $fileName);
        }

        $adAddForm->setError($adAddForm->getName().'_result', true, Text::$success);

        return $adAddForm->getErrors();
    }

    public function update(array $formData = [])
    {
        $adForm = new AdForm($formData);

        if (!$adForm->isValid()) {
            return $adForm->getErrors();
        }

        $adId = (int)$formData[$adForm->getName().'_adId'];
        $title = $formData[$adForm->getName().'_title'];
        $text = strip_tags($formData[$adForm->getName().'_text']);

        $adData = $this->getAdData($adId);

        /** @var User $user */
        $user = User::getInstance();

        if ($user->userId == $adData->userId) {
            $result = $this->model->update($adId, $title, $text);

            /** @var File $file */
            $file = File::getInstance();
            $fileName = $file->uploadFile($_FILES[$adForm->getName().'_image'], $adId);

            if ($fileName) {
                $this->model->updateFileName($adId, $fileName);
            }

            if ($result) {
                $adForm->setError($adForm->getName().'_result', true, Text::$success);

                return $adForm->getErrors();
            }
        }

        $adForm->setError($adForm->getName().'_result', false, Text::$error);

        return $adForm->getErrors();
    }

    public function delete($adId)
    {
        $adData = $this->getAdData($adId);

        /** @var User $user */
        $user = User::getInstance();

        if ($user->userId == $adData->userId) {
            return $this->model->delete($adId);

        }

        return false;
    }
}