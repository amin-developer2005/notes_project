<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/15/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


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

