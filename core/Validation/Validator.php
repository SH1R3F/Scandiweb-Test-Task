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

            if (str_contains($key, '.')) {
                $bits = explode('.', $key);

                foreach ($bits as $bit) {
                    if (isset($data[$bit])) {
                        $data = $data[$bit];
                        continue;
                    }

                    if ($bit === '*' && is_array($data)) {
                        foreach ($data as $k => $value) {
                            $this->run(str_replace('*', $k, $key), $value, $rule);
                        }
                        continue;
                    }
                }
                continue;
            }

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
            // Support rules with parameters. Ex: exists:products,id
            $expl = explode(':', $rule);
            $rule = $expl[0];
            $params = explode(',', $expl[1] ?? '');
            $rule = ucfirst($rule);

            if (!class_exists($validator = "\Scandiweb\Validation\Rules\\{$rule}Rule")) {
                throw new RuleNotFound;
            }

            $this->validate(new $validator, $key, $value, $params);
        }
    }

    /**
     * Run the validator and add the error message
     */
    public function validate(Rule $validator, string $key, mixed $value, array $arguments): void
    {
        if (!$validator->validate($key, $value, ...$arguments)) {
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