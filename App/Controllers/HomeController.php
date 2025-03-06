<?php

namespace App\Controllers;

use App\View\View;

class HomeController
{
    public function index(): void
    {
        View::render("index", ['heading' => "Home"]);
    }

    public function about(): void
    {
        View::render("about", ['heading' => "About"]);
    }

    public function contact(): void
    {
        View::render("contact", ['heading' => "contact"]);
    }
}

