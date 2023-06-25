<?php 

namespace Scandiweb\Validation\Rules;


/**
 * @property ?string $error
 */
interface Rule
{

    public function validate(string $key, mixed $value): bool;

    public function error(): string;
}
