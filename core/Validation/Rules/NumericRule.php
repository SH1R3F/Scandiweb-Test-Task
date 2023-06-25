<?php 

namespace Scandiweb\Validation\Rules;

class NumericRule implements Rule
{

    private ?string $error = null;

    public function validate(string $key, mixed $value): bool
    {
        // We dont require it to be required.
        if (empty($value)) {
            return true;
        }

        $passed = is_numeric($value);

        if (!$passed) {
            $this->error = "$key field must be numeric.";
        }

        return $passed;
    }


    public function error(): string
    {
        return $this->error;
    }
}