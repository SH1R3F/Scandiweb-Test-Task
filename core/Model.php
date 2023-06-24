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


    public static function all(): array
    {
        $model = new static;
        return $model->db->get('*', $model->table);
    }

    public static function find(int $id)
    {
        $model = new static;
        $model->attributes = $model->db->getOne('*', $model->table, $id);
        return $model;
    }

    public static function create(array $data)
    {
        $model = new static;

        if (isset($model->fillable)) {
            $data = array_filter($data, fn ($key) => in_array($key, $model->fillable), ARRAY_FILTER_USE_KEY);
        }

        $insert = $model->db->insert($model->table, $data);
        
        if ($insert) {
            return $model->find($model->db->pdo()->lastInsertId());
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
