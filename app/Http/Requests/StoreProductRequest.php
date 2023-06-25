<?php 

namespace App\Http\Requests;

use Scandiweb\Request;

class StoreProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'sku'    => ['required', 'unique:products,sku'],
            'name'   => ['required'],
            'price'  => ['required'],
            'type'   => ['required'],
            // 'weight' => ['required_if:type,book'],
            // 'size'   => ['required_if:type,dvd'],
            // 'height' => ['required_if:type,furniture'],
            // 'width'  => ['required_if:type,furniture'],
            // 'length' => ['required_if:type,furniture'],
        ];
    }
}