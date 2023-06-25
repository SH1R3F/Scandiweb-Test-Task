<?php 

namespace App\Http\Requests;

use Scandiweb\Request;

class StoreProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'sku'          => ['required', 'unique:products,sku'],
            'name'         => ['required'],
            'price'        => ['required', 'numeric'],
            'type'         => ['required'],
            'attrs.weight' => ['required_if:type,book', 'numeric'],
            'attrs.size'   => ['required_if:type,dvd', 'numeric'],
            'attrs.height' => ['required_if:type,furniture', 'numeric'],
            'attrs.width'  => ['required_if:type,furniture', 'numeric'],
            'attrs.length' => ['required_if:type,furniture', 'numeric'],
        ];
    }
}