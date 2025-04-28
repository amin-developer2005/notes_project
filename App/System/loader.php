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


session_start();

include BASE_PATH . "App/System/common.php";
include base_path('/vendor/autoload.php');

include BASE_PATH . "App/System/bootstrap.php";
include base_path("/App/System/routes.php");




include base_path("/App/View/View.php");
include base_path("/App/System/Traits/Validator.php");
include base_path("/App/System/Traits/AuthValidator.php");


use Dotenv\Dotenv;

$env = Dotenv::createImmutable(BASE_PATH);
$env->load();
