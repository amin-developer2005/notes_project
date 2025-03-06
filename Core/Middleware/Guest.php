<?php

namespace Core\Middleware;

use Core\Middleware\Middleware;
use Core\Redirect;

class Guest extends Middleware
{

    public function handle()
    {
        // TODO: Implement handle() method.
        if (isset($_SESSION['user']) ?? false) {
            Redirect::to('/home');
        }
    }
}