<?php

namespace Scandiweb;


class Session
{

    public const CSRF = 'csrf_token';

    public static function flash(string $key, mixed $value): void
    {
        $_SESSION['flash'][$key] = $value;
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key): mixed
    {
        if (static::has($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function clear(string $key): void
    {
        if (static::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public static function csrf(): string
    {
        $token = md5(uniqid(mt_rand(), true));
        static::set(static::CSRF, $token);

        return $token;
    }
}
