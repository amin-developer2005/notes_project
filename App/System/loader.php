<?php
session_start();

include BASE_PATH . "App/System/common.php";
//include base_path("/Core/Autoloader.php");
include base_path('/vendor/autoload.php');

include BASE_PATH . "App/System/bootstrap.php";
include base_path("/App/System/routes.php");




include base_path("/App/Controller/HomeController.php");
include base_path("/App/View/View.php");
include base_path("/App/System/Traits/Validator.php");
include base_path("/App/System/Traits/AuthValidator.php");


use Dotenv\Dotenv;

$env = Dotenv::createImmutable(BASE_PATH);
$env->load();
