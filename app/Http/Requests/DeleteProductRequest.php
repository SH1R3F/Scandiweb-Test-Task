<?php 

namespace App\Http\Requests;

use Scandiweb\Request;

class DeleteProductRequest extends Request
{
    public function rules()
    {
        return [
            'products' => 'required|array', // Validation rules can be a string
            'products.*' => ['required'] //, 'exists:products,id'] // Or an Array
        ];
    }
}