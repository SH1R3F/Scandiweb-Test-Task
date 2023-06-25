<?php

use App\Http\Controllers\ProductController;
use Scandiweb\Router;

Router::get('/', [ProductController::class, 'index']);
Router::delete('/products', [ProductController::class, 'destroy']);