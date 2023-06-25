<?php 

namespace Scandiweb;

class Redirect
{

    public static function to(string $path)
    {
        return header("Location: $path");
    }

}