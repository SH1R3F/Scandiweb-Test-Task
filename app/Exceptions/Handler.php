<?php 

namespace App\Exceptions;

use Scandiweb\Exceptions\RouteNotFound;
use Scandiweb\Redirect;
use Scandiweb\Session;
use Scandiweb\Validation\Exceptions\ValidationException;
use Scandiweb\View;
use Throwable;

class Handler
{

    public function __invoke(Throwable $e)
    {

        if ($e instanceof ValidationException) {
            // Redirect back with validation errors
            Session::flash('errors', $e->errors());

            Redirect::back();
        }


        if ($e instanceof RouteNotFound) {
            http_response_code(404);
        }

        echo View::make('errors/default', ['message' => $e->getMessage()]);
    }
}