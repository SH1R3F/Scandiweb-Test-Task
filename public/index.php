<?php

use App\Exceptions\Handler;
use Scandiweb\Container;
use Scandiweb\Database;
use Scandiweb\Router;

session_start();

// Include the composer autoloader
require __DIR__ . '/../vendor/autoload.php';

/**
 * Define Constants
 */
define('CONFIG_PATH', __DIR__ . '/../config/');
define('VIEW_PATH', __DIR__ . '/../views/');


/**
 * Set Global Exception Handler
 */
set_exception_handler(new Handler);


/**
 * Should implement a service provider and put these inside
 * But let's keep it simple for now
 */
// Add The Database instance to the container
Container::set(Database::class, fn () => Database::instance());


/**
 * Register routes
 */
require __DIR__ . '/../routes/web.php';

// Resolve current route
echo Router::resolve($_SERVER['REQUEST_URI']);
