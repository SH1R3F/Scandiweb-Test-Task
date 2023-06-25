<?php 

namespace App\Exceptions;

use Exception;

class Handler
{

    public function __invoke(Exception $e)
    {
        die('Hello there');
    }


}