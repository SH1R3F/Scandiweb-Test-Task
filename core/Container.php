<?php 

namespace Scandiweb;

use ReflectionClass;

class Container
{

    private static array $entries;


    public static function get(string $id)
    {
        if (static::has($id)) {
            $entry = static::$entries[$id];

            return $entry();
        }

        // return static::resolve($id);
    }


    public static function has(string $id): bool
    {
        return isset(static::$entries[$id]);
    }

    public static function set(string $class, callable $callable): void
    {
        static::$entries[$class] = $callable;
    }


    // public static function resolve(string $id)
    // {
    //     $reflectionClass = new ReflectionClass($id);

    // }
}