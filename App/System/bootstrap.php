<?php

use Core\Container;
use Core\Router;
use App\Controllers\App;
use Core\Middleware\Auth;
use Core\Middleware\Guest;


$container = new Container();

$container->bind(Router::class);

App::saveContainer($container);
