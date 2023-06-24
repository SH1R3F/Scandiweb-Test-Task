<?php 

namespace Scandiweb;

class Model
{

    private \PDO $pdo;


    public function __construct()
    {
        $this->pdo = Database::instance();
    }


    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM products');

        return $stmt->fetchAll();
    }


}