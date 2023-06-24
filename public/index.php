<?php

use Scandiweb\Container;
use Scandiweb\Database;

// Include the composer autoloader
require __DIR__ . '/../vendor/autoload.php';


define('CONFIG_PATH', __DIR__ . '/../config/');



/**
 * Should implement a service provider and put these inside
 * But let's keep it simple for now
 */
// Add The Database instance to the container
Container::set(Database::class, fn () => Database::instance());
