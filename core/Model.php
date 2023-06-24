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
        $stmt = $this->db->pdo()->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function find(int $id)
    {
        $stmt = $this->db->pdo()->prepare("SELECT * FROM {$this->table} WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $this->attributes = $stmt->fetch();

        return $this;
    }

    public function create(array $data)
    {
        if (isset($this->fillable)) {
            $data = array_filter($data, fn ($key) => in_array($key, $this->fillable), ARRAY_FILTER_USE_KEY);
        }

        $keys = implode(', ', array_keys($data));
        $placeholders = trim(array_reduce(array_keys($data), fn ($total, $item) => $total .= ":$item, ", ''), ', ');
        $stmt = $this->db->pdo()->prepare("INSERT INTO {$this->table} ($keys) VALUES ($placeholders)");
        
        if ($stmt->execute($data)) {
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
