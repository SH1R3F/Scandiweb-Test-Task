<?php 

namespace Scandiweb;

class Model
{

    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Container::get(\PDO::class);
    }


    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM products');

        return $stmt->fetchAll();
    }


}