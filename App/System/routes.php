<?php

use App\Controllers\RegisterController;
use App\Controllers\HomeController;
use App\Controllers\NoteController;
use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Router;
use App\Controllers\App;
use App\Controllers\SessionController;


$router = App::resolve(Router::class);


$router->get('/home', [HomeController::class, 'index']);
$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/contact', [HomeController::class, 'contact']);

$router->get('/account/register', [RegisterController::class, 'create'])->only(Guest::class);
$router->post('/account/register', [RegisterController::class, 'store'])->only(Auth::class);

$router->get('/account/login', [SessionController::class, 'create'])->only(Guest::class);
$router->post('/session/store', [SessionController::class, 'store'])->only(Guest::class);
$router->delete('/session/destroy', [SessionController::class, 'destroy'])->only(Auth::class);

$router->get('/notes', [NoteController::class, 'index'])->only(Auth::class);
$router->get('/notes/create', [NoteController::class, 'create'])->only(Auth::class);
$router->post('/notes/store', [NoteController::class, 'store'])->only(Auth::class);

$router->get('/note/show', [NoteController::class, 'show'])->only(Auth::class);
$router->get('/note/edit', [NoteController::class, 'edit'])->only(Auth::class);
$router->patch('/note/update', [NoteController::class, 'update'])->only(Auth::class);
$router->delete('/note/delete', [NoteController::class, 'delete'])->only(Auth::class);