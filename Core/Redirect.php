<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/25/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace Core;

use Exception;
use Core\Url;
use JetBrains\PhpStorm\NoReturn;


class Redirect
{

    public static function to(string $url, bool $isFullUrl = false, $exit = true): void
    {
        if ($isFullUrl) {
            header('Location: ' . $url);
        } else {
            header('Location: ' . Url::load($url));
        }

        if ($exit) {
            exit;
        }
    }


    public static function redirectToExternal(string $url): void
    {
        header('Location: ' . $url);
    }


    public static function toLogin(): void
    {
        self::to('/account/login');
    }




    public static function customRedirect(callable $callable): void
    {
        $path = $callable();

        if ($path)
            self::to($path);
    }
}