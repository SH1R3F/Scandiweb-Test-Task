<?php 

namespace Scandiweb\Validation\Rules;

class RequiredRule implements Rule
{

    private ?string $error = null;

    public function validate(string $key, mixed $value): bool
    {
        $value = is_string($value) ? trim($value) : $value;

        $empty = empty($value);

        if ($empty) {
            $this->error = "$key field is required.";
        }

        return !$empty;
    }


    public function error(): string
    {
        return $this->error;
    }
}