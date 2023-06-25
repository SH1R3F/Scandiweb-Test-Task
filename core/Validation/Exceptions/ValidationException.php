<?php 

namespace Scandiweb\Validation\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public $message = 'The given data was invalid.';

    private array $errors = [];


    public function withErrors(array $errors): static
    {
        $this->errors = $errors;
        return $this;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}