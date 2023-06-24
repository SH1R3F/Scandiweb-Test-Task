<?php 

namespace App\Models;

use Scandiweb\Model;
use Scandiweb\Casts\Attribute;

class Product extends Model
{
    /**
     * Table name
     */
    protected $table = 'products';

    /**
     * Fillable Attributes for mass assignment
     */
    protected $fillable = ['sku', 'name', 'price', 'type', 'attrs'];


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