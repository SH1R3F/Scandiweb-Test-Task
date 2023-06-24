<?php 

namespace Scandiweb\Casts;

class Attribute
{

    public function __construct(public $get, public $set)
    {
        
    }

    public static function make(?callable $get = null, ?callable $set = null)
    {
        return new static($get, $set);
    }
}