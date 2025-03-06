<?php

namespace Core\Middleware;

use Core\Middleware\Auth;
use Core\Middleware\Guest;


class Middleware
{



    protected static array $middlewares = [
        'auth' => Auth::class,
        'guest' => Guest::class,
    ];




    public static function resolve($field): void
    {
        if (! $field) {
            return;
        }

        if (! $middleware = static::$middlewares[$field] ?? null) {
            throw new \Exception("The middleware '$field' does not exist.");
        }

        (new $middleware)->handle();
    }


}