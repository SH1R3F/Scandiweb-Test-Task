<?php 

namespace Scandiweb\Validation\Rules;

use Scandiweb\Container;
use Scandiweb\Request;

class RequiredIfRule implements Rule
{

    private ?string $error = null;
    private Request $request;

    public function __construct()
    {
        $this->request = Container::get(Request::class);
    }

    public function validate(string $key, mixed $value, ...$arguments): bool
    {
        [$attr, $attrVal] = $arguments;

        if (!$this->request->get($attr) || $this->request->get($attr) != $attrVal) {
            return true;
        }

        $value = is_string($value) ? trim($value) : $value;
        $empty = empty($value);

        if ($empty) {
            $this->error = "$key field is required as long as field $attr is $attrVal.";
        }

        return !$empty;
    }


    public function error(): string
    {
        return $this->error;
    }
}