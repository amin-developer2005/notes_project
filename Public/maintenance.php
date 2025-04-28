<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/3/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


use App\Controllers\App;
use Core\Redirect;
use Core\Session;
use Core\Url;
use Core\Router;
use Core\ValidationException;


const BASE_PATH = __DIR__ . '/../';
include BASE_PATH . "App/System/loader.php";


$uri = Url::getRequestUrl();

$router = App::resolve(Router::class);
include base_path("/App/System/routes.php");


try {
    $router->route($uri, $_POST['_method'] ?? Url::fetchRequestMethod());
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    $router->goBack();
}

