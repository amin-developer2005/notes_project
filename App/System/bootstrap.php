<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/25/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


use Core\Container;
use Core\Router;
use App\Controllers\App;
use Core\Middleware\Auth;
use Core\Middleware\Guest;


$container = new Container();

$container->bind(Router::class);

App::saveContainer($container);
