<?php 

namespace Scandiweb\Validation\Rules;

class ArrayRule implements Rule
{

    private ?string $error = null;

    public function validate(string $key, mixed $value): bool
    {
        $passed = is_array($value);

        if (!$passed) {
            $this->error = "$key field must be an array.";
        }

        return $passed;
    }


    public function error(): string
    {
        return $this->error;
    }
}