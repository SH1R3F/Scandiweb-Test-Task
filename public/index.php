<?php

use Scandiweb\Model;

// Include the composer autoloader
require __DIR__ . '/../vendor/autoload.php';


$products = (new Model)->all();

echo '<pre>';
print_r($products);