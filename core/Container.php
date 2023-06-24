<?php 

namespace Scandiweb;

class Container
{

    private array $entries;


    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];

            return $entry();
        }

        // Resolve it magically

    }


    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $class, callable $callable): void
    {
        $this->entries[$class] = $callable;
    }
}