<?php

namespace Form;

use Text;
use Base\Form;
use Service\Token;

class AdForm extends Form
{
    protected $formName = 'ad_form';

    protected function validate()
    {
        $this->isValid = true;
        /** @var Token $token */
        $token = Token::getInstance();

        if (!$token->checkToken($this->formData, $this->formName)) {
            $this->errors[] = [$this->formName.'_result', false, Text::$csrf];
            $this->isValid = false;
        }

        if (!isset($this->formData[$this->formName.'_title'])) {
            $this->errors[] = [$this->formName.'_title', false, Text::$title];
            $this->isValid = false;
        }

        if (!isset($this->formData[$this->formName.'_text'])) {
            $this->errors[] = [$this->formName.'_text', false, Text::$text];
            $this->isValid = false;
        }

        if ($this->isValid()) {
            $this->errors[] = [$this->formName.'_result', true, Text::$success];
        }

        return;
    }
}