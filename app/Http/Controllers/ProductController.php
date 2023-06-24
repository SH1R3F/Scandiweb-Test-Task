<?php

namespace App\Http\Controllers;

use Scandiweb\View;

class ProductController
{
    public function index()
    {
        return View::make('products/index', ['var' => 'value']);
    }
}