<?php


namespace Tests\Unit\Requests;


use Illuminate\Support\Facades\Validator;

trait PrepareValidator
{
    private $validationRules;

    private function getFieldValidator($field, $value)
    {
        return Validator::make(
            [$field => $value],
            [$field => $this->validationRules[$field]]);
    }

    private function validateField($field, $value): bool
    {
        return $this->getFieldValidator($field, $value)->passes();
    }
}