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
     * Get the price display value.
     */
    protected function price()
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (int $value) => $value * 100
        );
    }

    /**
     * Decode the attributes for display
     */
    protected function attrs()
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value, 1),
            set: fn (mixed $value) => json_encode($value)
        );
    }
}