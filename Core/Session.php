<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 3/3/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace Core;



class Session
{

    public static function start()
    {
        if (session_start() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function put(string|array $field, $value): void
    {
        if (is_array($field)) {
            $session = &$_SESSION;

            foreach ($field as $item) {
                if (! isset($session[$item]) || ! is_array($session[$item])) {
                    $session[$item] = [];
                }

                $session = &$session[$item];
            }

            $session = $value;
            return;
        }

        $_SESSION[$field] = $value;
        var_dump($_SESSION);
    }


    public static function fetch($field = null, $default = null): mixed
    {
        if (is_null($field)) {
            return $_SESSION;
        }

        return static::fetchFlash($field) ?? $_SESSION[$field] ?? $default;
    }


    public static function has($field): bool
    {
        return null !== static::fetch($field);
    }


    public static function remove(string|array|null $field = null): void
    {
        if (is_string($field)) {
            unset($_SESSION[$field]);
            return;
        }

        if (is_array($field)) {
            $session = &$_SESSION;
            $path = [];

            $lastField = array_pop($field);

            foreach ($field as $item) {
                if (! isset($session[$item]) || ! is_array($session[$item])) {
                    throw new \Exception("");
                }

                $path[] = [&$session, $item];
                $session = &$session[$item];
            }

            unset($session[$lastField]);


            while(! empty($path)) {

                [$parent, $lastKey] = array_pop($path);

                if (! empty($parent[$lastKey])) {
                    break;
                }

                unset($parent[$lastKey]);
            }

        }

    }



    public static function isset($field = null): bool
    {
        if (is_null($field)) {
            return isset($_SESSION);
        }

        return isset($_SESSION[$field]);
    }




    public static function flash($field, $value): void
    {
        static::put(['__flash', $field], $value);
    }



    public static function unFlash(): void
    {
        static::remove('__flash');
    }



    public static function hasFlash($field): bool
    {
        return isset($_SESSION['__flash'][$field]);
    }



    public static function fetchFlash($field = null, $default = null): mixed
    {
        if (is_null($field)) {
            return static::flashExists() ? $_SESSION['__flash'] : $default;
        }

        if (static::hasFlash($field)) {
            $val = $_SESSION['__flash'][$field];
            static::unFlash();
            return $val;
        }

        return $default;
    }




    public static function flashExists(): bool
    {
        return isset($_SESSION['__flash']);
    }

    

    public static function removeFlash($field): void
    {
        unset($_SESSION['__flash'][$field]);
    }


    public static function flush(): void
    {
        $_SESSION = [];
        session_unset();
    }


    public static function destroy(): void
    {
        static::flush();
        session_destroy();

        $cookieParams = session_get_cookie_params();

        setcookie('PHPSESSID', '', time() - 3600, $cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'], $cookieParams['httponly']);
    }

}
