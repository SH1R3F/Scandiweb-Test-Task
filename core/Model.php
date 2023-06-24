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


    public function attributes()
    {
        return $this->attributes;
    }


    public function __get($attribute)
    {
        if (array_key_exists($attribute, $this->attributes)) {
            return $this->attributes[$attribute];
        }
    }
}