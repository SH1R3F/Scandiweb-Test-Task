<?php 

namespace Scandiweb;

abstract class Model
{

    private \PDO $pdo;

    protected $table;

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
        return $stmt->fetch();
    }
}