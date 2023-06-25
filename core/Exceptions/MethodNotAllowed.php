<?php 


namespace Scandiweb\Exceptions;

use Exception;

class MethodNotAllowed extends Exception
{

    public $message = 'Route Method Not Allowed!';

}