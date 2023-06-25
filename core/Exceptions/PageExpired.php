<?php 


namespace Scandiweb\Exceptions;

use Exception;

class PageExpired extends Exception
{

    public $message = 'Page expired or invalid CSRF token';

}