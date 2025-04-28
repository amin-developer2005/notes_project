<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/7/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace App\Controllers;

use Core\Container;


class App
{
    private static Container $container;


    public static function saveContainer(Container $container): void
    {
        static::$container = $container;
    }

    public static function fetchContainer(): Container
    {
        return static::$container;
    }


    public static function bind($field, $resolve): void
    {
        static::$container->bind($field, $resolve);
    }

    /**
     * @throws \Exception
     */
    public static function resolve($field)
    {
        return static::$container->resolve($field);
    }
}