<?php

namespace Scandiweb;

class Redirect
{

    public static function to(string $path)
    {
        return header("Location: $path");
    }

    public static function back()
    {
        return header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
