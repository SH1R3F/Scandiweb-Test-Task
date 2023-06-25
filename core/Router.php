<?php

namespace Scandiweb;

use Scandiweb\Exceptions\RouteNotFound;

class Router
{
    private static array $routes = [];


    private static function addRoute(string $request_method, string $path, callable|array $action): void
    {
        $path = rtrim($path, '/');
        static::$routes[$path][$request_method] = $action;
    }

    public static function get(string $path, callable|array $action): void
    {
        static::addRoute('GET', $path, $action);
    }

    public static function post(string $path, callable|array $action): void
    {
        static::addRoute('POST', $path, $action);
    }

    public static function delete(string $path, callable|array $action): void
    {
        static::addRoute('DELETE', $path, $action);
    }

    /**
     * Add other request methods here if needed
     */


    /**
     * Route Resolver
     */
    public static function resolve($url, $request_method)
    {
        ['path' => $path] = parse_url($url);
        $path = rtrim($path, '/');

        if (!isset(static::$routes[$path])) {
            throw new RouteNotFound();
        }

        if (!isset(static::$routes[$path][$request_method])) {
            throw new RouteNotFound('Route Method Not Allowed!');
        }


        $action = static::$routes[$path][$request_method];

        if (is_array($action)) {
            [$class, $method] = $action;
            
            return call_user_func([Container::get($class), $method], []);
        }

        return $action();
    }
}
