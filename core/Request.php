<?php 

namespace Scandiweb;

class Request
{

    private array $request;

    public function __construct()
    {
        $this->request = $_REQUEST;
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