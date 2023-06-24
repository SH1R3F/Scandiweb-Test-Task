<?php

namespace Scandiweb;

class Database
{

    private static $connection = null;

    /**
     * Private constructor to disable instantiation from outside the class
     */
    private function __construct()
    {
        try {
            static::$connection = new \PDO('mysql:host=localhost;dbname=scandiweb', 'root', 'toor', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
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
            static::$connection = new static;
        }

        return static::$connection;
    }
}
