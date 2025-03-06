<?php

namespace Controller;

use Core\Redirect;
use App\View\View;

class HomeController
{
    public function index()
    {
        dd($this);
        View::render("index.view.php", ['heading' => "Home"]);
    }

    public function about()
    {
        View::render("about.view.php", ['heading' => "About"]);
    }

    public function contact()
    {
        View::render("contact.view.php", ['heading' => "contact"]);
    }


}