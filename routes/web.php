<?php

use App\Http\Controllers\ProductController;
use Scandiweb\Router;

Router::get('/', [ProductController::class, 'index']);
Router::get('/add-product', [ProductController::class, 'create']);
Router::delete('/products', [ProductController::class, 'destroy']);