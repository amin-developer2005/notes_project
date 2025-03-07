<?php

namespace Core\Middleware;

use App\Controllers\App;
use Core\Middleware\Auth;
use Core\Middleware\Guest;


class Middleware
{

    protected static array $middlewares = [
        Auth::class,
        Guest::class,
    ];


    /**
     * @throws \Exception
     */
    public static function resolver($middleware)
    {
        if (! $middleware) {
            return;
        }

        if (! in_array($middleware, self::$middlewares, true)) {
            throw new \Exception("Middleware class {{$middleware}} not exist.");
        }

        App::resolve($middleware)->handle();
    }

}