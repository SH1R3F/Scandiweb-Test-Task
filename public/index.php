<?php

use App\Models\Product;
use Scandiweb\Container;
use Scandiweb\Database;

// Include the composer autoloader
require __DIR__ . '/../vendor/autoload.php';


// Add The Database instance to the container
Container::set(\PDO::class, fn() => Database::instance());


// List Products
$product = (new Product)->find(1);

echo $product->id . '<br>';
echo $product->name . '<br>';
echo $product->price . '<br>';