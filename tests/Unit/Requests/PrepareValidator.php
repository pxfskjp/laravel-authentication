<?php


namespace Tests\Unit\Requests;


trait PrepareValidator
{
    private $rules;
    private $validator;


    private function getFieldValidator($field, $value)
    {
        return $this->validator->make(
            [$field => $value],
            [$field => $this->rules[$field]]
        );
    }

    private function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }
}