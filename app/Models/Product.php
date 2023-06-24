<?php 

namespace App\Models;

use Scandiweb\Model;

class Product extends Model
{
    protected $table = 'products';


    public function getPriceAttribute()
    {
        return $this->price / 100;
    }

    /**
     * Get the prive display value.
     */
    protected function price()
    {
        return fn (int $value) => $value / 100;
    }
}