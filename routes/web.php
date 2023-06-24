<?php

use App\Http\Controllers\ProductController;
use Scandiweb\Router;

// Router::get('/', function() {
//     echo 'Hello World!';
// });

Router::get('/', [ProductController::class, 'index']);