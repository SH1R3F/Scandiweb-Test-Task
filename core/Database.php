<?php

namespace Scandiweb;

class Database
{

    private static ?\PDO $connection = null;
    private static ?Database $instance = null;

    /**
     * Private constructor to disable instantiation from outside the class
     */
    private function __construct()
    {
        try {
            static::$connection = new \PDO('mysql:host=localhost;dbname=scandiweb', 'root', 'toor', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);

            echo 'Connected to DB <br>';
        } catch (\PDOException $e) {
            die('Failed connecting to db');
        }
    }

    /**
     * Always use single connection
     */
    public static function instance()
    {
        if (!static::$connection) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function pdo()
    {
        return static::$connection;
    }

    /**
     * Database Queries
     */
    public function get(string $columns, string $table): array
    {
        $stmt = static::$connection->query("SELECT $columns FROM $table");
        return $stmt->fetchAll();
    }

    public function getOne(string $columns, string $table, int $id)
    {
        $stmt = static::$connection->prepare("SELECT $columns FROM $table WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insert(string $table, array $data)
    {
        $keys = implode(', ', array_keys($data));
        $placeholders = trim(array_reduce(array_keys($data), fn ($total, $item) => $total .= ":$item, ", ''), ', ');

        $stmt = static::$connection->prepare("INSERT INTO $table ($keys) VALUES ($placeholders)");
        return $stmt->execute($data);
    }
}
