<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Scandiweb\Redirect;
use Scandiweb\Request;
use Scandiweb\View;

class ProductController
{

    public function __construct(private Request $request)
    {
    }

    public function index(): View
    {
        $products = Product::all();

        return View::make('products/index', ['products' => $products]);
    }

    public function create(): View
    {
        return View::make('products/create');
    }

    public function store()
    {
        // Validate
        $request = new StoreProductRequest;
        
        // Create
        $product = Product::create($request->all());

        return Redirect::to('/');
    }

    public function destroy()
    {
        $request = new DeleteProductRequest;

        $products_ids = $request->get('products');
        Product::delete($products_ids);

        return Redirect::to('/');
    }
}