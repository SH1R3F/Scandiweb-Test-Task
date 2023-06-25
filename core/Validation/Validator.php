<?php 

namespace Scandiweb\Validation;

use Scandiweb\Validation\Exceptions\RuleNotFound;
use Scandiweb\Validation\Rules\Rule;

class Validator
{

    /**
     * Errors bag
     */
    private array $errors = [];


    public function __construct(array $data, array $rules)
    {
        foreach ($rules as $key => $rule) {
            $this->run($key, $data[$key] ?? null, $rule);
        }        
    }


    /**
     * Run the validation process
     */
    public function run(string $key, mixed $value, string|array $rules): void
    {
        $rules = is_array($rules) ? $rules : explode('|', $rules);

        foreach ($rules as $rule) {
            $rule = ucfirst($rule);

            if (!class_exists($validator = "\Scandiweb\Validation\Rules\\{$rule}Rule")) {
                throw new RuleNotFound;
            }

            $this->validate(new $validator, $key, $value);
        }
    }

    /**
     * Run the validator and add the error message
     */
    public function validate(Rule $validator, string $key, mixed $value): void
    {
        if (!$validator->validate($key, $value)) {
            $this->errors[$key][] = $validator->error();
        }
    }


    /**
     * Errors bag getter
     */
    public function errors(): array
    {
        return $this->errors;
    }


    public static function make(array $data, array $rules): static
    {
        return new static($data, $rules);
    }
}