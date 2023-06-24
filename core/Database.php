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

}
