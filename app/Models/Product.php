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
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => number_format($value / 100, 2),
            set: fn (int|float $value) => $value * 100
        );
    }

    /**
     * Attributes Accessor and Mutator
     */
    protected function attrs(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                $method = $this->type . 'Attrs';
                return $this->$method(json_decode($value, 1));
            },
            set: fn (mixed $value) => json_encode($value)
        );
    }

    private function dvdAttrs(array $attrs): string
    {
        return 'Size: ' . $attrs['size'] . ' MB';
    }
    private function bookAttrs(array $attrs): string
    {
        return 'Weight: ' . $attrs['weight'] . 'KG';
    }
    private function furnitureAttrs(array $attrs): string
    {
        return "Dimension: {$attrs['height']}x{$attrs['width']}x{$attrs['length']}";
    }
}