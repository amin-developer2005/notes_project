<?php

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