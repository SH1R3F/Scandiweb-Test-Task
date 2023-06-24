<?php

namespace Scandiweb;

abstract class Model
{

    private Database $db;
    private array $attributes = [];

    /**
     * Table name
     */
    protected $table;

    /**
     * Fillable Attributes for mass assignment
     */
    protected $fillable;


    public function __construct()
    {
        $this->db = Container::get(Database::class);
    }


    public function all(): array
    {
        return $this->db->get('*', $this->table);
    }

    public function find(int $id)
    {
        $this->attributes = $this->db->getOne('*', $this->table, $id);
        return $this;
    }

    public function create(array $data)
    {
        if (isset($this->fillable)) {
            $data = array_filter($data, fn ($key) => in_array($key, $this->fillable), ARRAY_FILTER_USE_KEY);
        }

        $insert = $this->db->insert($this->table, $data);
        
        if ($insert) {
            return $this->find($this->db->pdo()->lastInsertId());
        }
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
