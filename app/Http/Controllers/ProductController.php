<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Scandiweb\View;

class ProductController
{
    public function index()
    {
        $products = Product::all();

        return View::make('products/index', ['products' => $products]);
    }
}