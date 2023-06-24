<?php

namespace Scandiweb;

abstract class Model
{

    private \PDO $pdo;

    protected $table;

    private array $attributes = [];

    public function __construct()
    {
        $this->pdo = Container::get(\PDO::class);
    }


    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $this->attributes = $stmt->fetch();

        return $this;
    }


    public function attributes(): array
    {
        return $this->attributes;
    }


    public function __get(string $attribute): mixed
    {
        if (!array_key_exists($attribute, $this->attributes)) {
            return null;
        }

        // Support accessors
        if (method_exists($this, $attribute)) {
            $accessor = $this->$attribute();
            return ($accessor->get)($this->attributes[$attribute]);
        }

        return $this->attributes[$attribute];
    }

    public function __set(string $name, mixed $value): void
    {
        if (property_exists($this, $name)) {
            return;
        }

        // Support mutators
        if (method_exists($this, $name)) {
            $accessor = $this->$name();
            $this->attributes[$name] = ($accessor->set)($value);
            return;
        }

        $this->attributes[$name] = $value;
    }
}
