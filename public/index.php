<?php

use Scandiweb\Container;
use Scandiweb\Database;

// Include the composer autoloader
require __DIR__ . '/../vendor/autoload.php';


// Add The Database instance to the container
Container::set(\PDO::class, fn() => Database::instance());
