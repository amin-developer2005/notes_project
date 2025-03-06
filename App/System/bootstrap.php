<?php

use Core\Container;
use Core\Router;
use App\Controllers\App;
use Core\Middleware\Auth;
use Core\Middleware\Guest;


$container = new Container();

$container->bind(Router::class, function () {
    return new Router();
});

$container->bind(Auth::class, function () {
    return new Auth();
});

$container->bind(Guest::class, function () {
    return new Guest();
});


App::saveContainer($container);
