<?php 

namespace Scandiweb\Validation\Exceptions;

use Exception;

class RuleNotFound extends Exception
{
    public $message = 'Rule not found!';
}