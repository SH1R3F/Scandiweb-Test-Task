<?php 

namespace Scandiweb\Validation\Rules;

use Scandiweb\Container;
use Scandiweb\Database;

class UniqueRule implements Rule
{

    private ?string $error = null;
    private ?Database $db = null;

    public function __construct()
    {
        $this->db = Container::get(Database::class);
    }


    public function validate(string $key, mixed $value, ...$arguments): bool
    {
        [$table, $column] = $arguments;
        $passed = !$this->db->count($table, [$column => $value]);

        if (!$passed) {
            $this->error = "$key field already exists";
        }

        return $passed;
    }


    public function error(): string
    {
        return $this->error;
    }
}