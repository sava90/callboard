<?php

namespace Service;

use Form\LoginForm;
use Form\RegistrationForm;
use Form\SettingsForm;
use Text;
use Base\Service;
use Model\UserModel;

class User extends Service
{
    protected function __construct()
    {
        $userId = isset($_SESSION['userId']) ? (int)$_SESSION['userId'] : 0;
        $this->model = new UserModel($userId);
    }

    public function getUserData($userId)
    {
        return $this->model->getUserData($userId);
    }

    public function getUsers()
    {
        return $this->model->getUsers();
    }

    public function isLoggedIn()
    {
        return $this->model->userId ? (int)$this->model->userId : false;
    }

    public function checkDuplicateEmail($email)
    {
        return $this->model->checkDuplicateEmail($email);
    }

    public function createAccount(array $formData = [])
    {
        $registrationForm = new RegistrationForm($formData);

        if (!$registrationForm->isValid()) {
            return $registrationForm->getErrors();
        }

        $login = $formData[$registrationForm->getName().'_login'];
        $username = $formData[$registrationForm->getName().'_username'];
        $email = $formData[$registrationForm->getName().'_email'];
        $password = password_hash($formData[$registrationForm->getName().'_password'], PASSWORD_BCRYPT);

        $lastInsertId = $this->model->createAccount($login, $username, $email, $password);

        if (!$lastInsertId) {
            $registrationForm->setError($registrationForm->getName().'_result', false, Text::$error);

            return $registrationForm->getErrors();
        }

        $registrationForm->setError($registrationForm->getName().'_result', true, Text::$success);

        return $registrationForm->getErrors();
    }

    public function login(array $formData = [])
    {
        $loginForm = new LoginForm($formData);

        if (!$loginForm->isValid()) {
            return $loginForm->getErrors();
        }

        $email = $formData[$loginForm->getName().'_email'];
        $password = $formData[$loginForm->getName().'_password'];

        $userData = $this->model->getUserByEmail($email);

        if ($userData && password_verify($password, $userData->password)) {
            $loginForm->setError($loginForm->getName().'_result', true, Text::$success);
            $_SESSION['userId'] = $userData->userId;

            return $loginForm->getErrors();
        }

        $loginForm->setError($loginForm->getName().'_result', false, Text::$error);

        return $loginForm->getErrors();
    }

    public function updateSettings(array $formData = [])
    {
        $settingsForm = new SettingsForm($formData);

        if (!$settingsForm->isValid()) {
            return $settingsForm->getErrors();
        }

        $login = $formData[$settingsForm->getName().'_login'];
        $username = $formData[$settingsForm->getName().'_username'];

        $result = $this->model->updateSettings($this->userId, $login, $username);

        if ($result) {
            $settingsForm->setError($settingsForm->getName().'_result', true, Text::$success);

            return $settingsForm->getErrors();
        }

        $settingsForm->setError($settingsForm->getName().'_result', false, Text::$error);

        return $settingsForm->getErrors();
    }
}