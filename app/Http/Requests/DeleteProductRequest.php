<?php 

namespace App\Http\Requests;

use Scandiweb\Request;

class DeleteProductRequest extends Request
{
    public function rules()
    {
        return [
            'products' => ['required', 'array'],
            // 'products.*' => ['required', 'exists:products,id']
        ];
    }
}