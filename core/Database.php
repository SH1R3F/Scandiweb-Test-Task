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
            static::$connection = new \PDO('mysql:host=' . Config::get('database.host') . ';dbname=' . Config::get('database.database'), Config::get('database.username'), Config::get('database.password'), [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);

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

    public function count(string $table, array $where)
    {
        $clause = array_reduce(array_keys($where), fn($total, $item) => ($total . "$item = ? AND "), '');

        $stmt = static::$connection->prepare("SELECT COUNT(*) FROM $table WHERE " . rtrim($clause, ' AND '));
        $stmt->execute(array_values($where));
        return $stmt->fetchColumn();
    }

    public function delete(string $table, array $where)
    {
        $clause = array_reduce(array_keys($where), fn($total, $item) => ($total . "$item = ? AND "), '');
        $stmt = static::$connection->prepare("DELETE FROM $table WHERE " . rtrim($clause, ' AND '));
        return $stmt->execute(array_values($where));
    }

    public function deleteMany(string $table, array $ids)
    {
        $clause = array_reduce(array_keys($ids), fn($total, $id) => ($total . "?, "), '');
        $stmt = static::$connection->prepare("DELETE FROM $table WHERE id IN (" . rtrim($clause, ', ') . ")");
        return $stmt->execute(array_values($ids));
    }
}
