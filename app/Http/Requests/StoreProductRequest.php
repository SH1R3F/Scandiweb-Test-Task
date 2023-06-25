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
            'price'        => ['required'],
            'type'         => ['required'],
            'attrs.weight' => ['required_if:type,book'],
            'attrs.size'   => ['required_if:type,dvd'],
            'attrs.height' => ['required_if:type,furniture'],
            'attrs.width'  => ['required_if:type,furniture'],
            'attrs.length' => ['required_if:type,furniture'],
        ];
    }
}