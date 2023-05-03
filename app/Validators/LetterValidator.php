<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class LetterValidator extends AbstractValidator
{

    protected string $message = 'Поле :field должно сождержать только буквы и символы';

    public function rule(): bool
    {
        return preg_match("/^([а-яА-ЯЁё]+)$/u", $this->value);
    }
}
