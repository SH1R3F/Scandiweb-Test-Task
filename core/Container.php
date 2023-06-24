<?php

namespace Scandiweb;

use Exception;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;

class Container
{

    private static array $entries;


    public static function get(string $id)
    {
        if (static::has($id)) {
            $entry = static::$entries[$id];

            return $entry();
        }

        return static::resolve($id);
    }


    public static function has(string $id): bool
    {
        return isset(static::$entries[$id]);
    }

    public static function set(string $class, callable $callable): void
    {
        static::$entries[$class] = $callable;
    }


    public static function resolve(string $id)
    {
        $reflectionClass = new ReflectionClass($id);
        $constructor     = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $id;
        }


        $params = $constructor->getParameters();

        if (!$params) {
            return new $id;
        }


        // Prepare the dependencies
        $args = array_map(function (ReflectionParameter $param) {
            $type = $param->getType();
            $name = $param->getName();

            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                return static::get($type);
            }

            throw new Exception("Class $type for parameter $name cannot be injected");
        }, $params);

        return $reflectionClass->newInstanceArgs($args);
    }
}
