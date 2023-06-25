<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Scandiweb\View;

class ProductController
{
    public function index(): View
    {
        $products = Product::all();

        return View::make('products/index', ['products' => $products]);
    }

    public function destroy()
    {
        echo '<pre>';
        var_dump($_REQUEST);
    }
}