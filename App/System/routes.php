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

$router->get('/account/register', [RegisterController::class, 'create'])->only('guest');
$router->post('/account/register', [RegisterController::class, 'store'])->only('guest');

$router->get('/account/login', [SessionController::class, 'create'])->only('guest');
$router->post('/session/store', [SessionController::class, 'store'])->only('guest');
$router->delete('/session/destroy', [SessionController::class, 'destroy'])->only('auth');

$router->get('/notes', [NoteController::class, 'index'])->only('auth');
$router->get('/notes/create', [NoteController::class, 'create'])->only('auth');
$router->post('/notes/store', [NoteController::class, 'store'])->only('auth');

$router->get('/note/show', [NoteController::class, 'show'])->only('auth');
$router->get('/note/edit', [NoteController::class, 'edit'])->only('auth');
$router->patch('/note/update', [NoteController::class, 'update'])->only('auth');
$router->delete('/note/delete', [NoteController::class, 'delete'])->only('auth');