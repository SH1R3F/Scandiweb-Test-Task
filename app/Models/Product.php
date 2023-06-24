<?php 

namespace App\Models;

use Scandiweb\Model;
use Scandiweb\Casts\Attribute;

class Product extends Model
{
    protected $table = 'products';


    public function getPriceAttribute()
    {
        return $this->price / 100;
    }

    /**
     * Price Accessor and Mutator
     */
    protected function price()
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (int $value) => $value * 100
        );
    }

    /**
     * Attributes Accessor and Mutator
     */
    protected function attrs()
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value, 1),
            set: fn (mixed $value) => json_encode($value)
        );
    }
}