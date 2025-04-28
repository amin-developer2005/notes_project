<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/4/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace Core;

class Autoloader
{
    /**
     * @throws \Exception
     */
    public static function load($class)
    {
        $classFile = str_replace('\\', "/", $class);
        $classPath = base_path( $classFile . '.php');

        if (! file_exists($classPath) && ! is_readable($classPath)) {
            throw new \Exception("Class $classPath not exists in the project.");
        }

        include $classPath;
    }
}

spl_autoload_register([Autoloader::class, 'load']);
