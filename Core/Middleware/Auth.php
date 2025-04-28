<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 3/1/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace Core\Middleware;

use Core\Middleware\Middleware;
use Core\Response;


class Auth extends Middleware
{

    public function handle(): void
    {
        // TODO: Implement handle() method.
        if (! isset($_SESSION['user']) ?? false) {
            abort(Response::FORBIDDEN);
        }
    }
}