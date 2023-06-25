<?php 

namespace Scandiweb;

use Scandiweb\Validation\Exceptions\ValidationException;
use Scandiweb\Validation\Validator;

class Request
{

    private array $request;

    public function __construct()
    {
        $this->request = $_REQUEST;

        // Validate
        $validator = Validator::make($this->request, $this->rules());
        if ($validator->errors()) {
            throw (new ValidationException)->withErrors($validator->errors());
        }
    }

    public function rules(): array
    {
        return [];
    }


    public function all(): array
    {
        return $this->request;
    }

    public function has(string $key): bool
    {
        return isset($this->request[$key]);
    }

    public function get(string $key): mixed
    {
        if (!$this->has($key)) {
            return null;
        }

        return $this->request[$key];
    }
}