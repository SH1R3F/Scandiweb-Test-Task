<?php

use App\Http\Controllers\ProductController;
use Scandiweb\Router;

Router::get('/', [ProductController::class, 'index']);
Router::get('/add-product', [ProductController::class, 'create']);
Router::post('/add-product', [ProductController::class, 'store']);
Router::delete('/products', [ProductController::class, 'destroy']);