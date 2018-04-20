<?php

namespace Form;

use Text;
use Base\Form;
use Service\Token;

class SettingsForm extends Form
{
    protected $formName = 'settings_form';

    protected function validate()
    {
        $this->isValid = true;
        /** @var Token $token */
        $token = Token::getInstance();

        if (!$token->checkToken($this->formData, $this->formName)) {
            $this->errors[] = [$this->formName.'_result', false, Text::$csrf];
            $this->isValid = false;
        }

        if (!isset($this->formData[$this->formName.'_login'])) {
            $this->errors[] = [$this->formName.'_login', false, Text::$login];
            $this->isValid = false;
        }

        if (!isset($this->formData[$this->formName.'_username'])) {
            $this->errors[] = [$this->formName.'_username', false, Text::$username];
            $this->isValid = false;
        }

        if ($this->isValid()) {
            $this->errors[] = [$this->formName.'_result', true, Text::$success];
        }

        return;
    }
}