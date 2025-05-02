<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/12/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


use Core\Response;
use Core\Session;
use Core\Url;
use JetBrains\PhpStorm\NoReturn;
use App\View\View;


#[NoReturn] function dd($data)
{
    echo "<pre>" . var_dump($data) . "</pre>";
    die();
}


#[NoReturn] function abort($code = 404): void
{
    http_response_code($code);
    View::render($code, ['heading' => '403 Forbidden']);
    die();
}



function config($field)
{
    $config = require(base_path('App/config.php'));

    if (! array_key_exists($field, $config)) {
        throw new Exception("Config [$field] not found");
    }

    return $config[$field];
}




function base_path($path): string
{
    return BASE_PATH . $path;
}

function view($view, $data = []): void
{
    if ($data) {
        extract($data);
    }

    require (base_path($view));
}


function urlIs($uri): bool
{
    return Url::getRequestUrl() === $uri;
}


function authorize(bool $condition, $status = Response::FORBIDDEN): true
{
    if (! $condition) {
        abort($status);
    }
    return true;
}




function generateHashArgon($password): string
{
    $options = [
        'memory_cost' => 1<<17,
        'time_cost' => 4,
        'threats' => 2
    ];
    return password_hash($password, PASSWORD_ARGON2ID, $options);
}



function isGuest(): bool
{
    return ! Session::isset('user') || Session::fetch('user')['logged_in'] === false;
}


function isUser(): bool
{
    return Session::isset('user') && Session::fetch('user')['logged_in'] === true;
}



function old($field, $default = null)
{
    return Session::fetchFlash($field);
    return Session::fetchFlash($field) ?? $default;
}