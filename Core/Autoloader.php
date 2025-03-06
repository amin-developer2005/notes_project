<?php

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
