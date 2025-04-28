<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/18/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace App\Controllers;

use Core\Url;
use Core\Redirect;
use Core\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Core\Authenticator;
use App\View\View;
use App\Forms\LoginForm;
use Core\Session;



class SessionController
{

    public function create(): void
    {
        View::render('session/create', ['heading' => 'Log In to your account', 'errors' => Session::fetchFlash('errors') ?? []]);
    }


    /**
     * @throws ValidationException
     */
    public function store(): void
    {
        $loginForm = LoginForm::validate($data = [
                'email'     =>   Url::fetchPost('email'),
                'password'  => Url::fetchPost('password'),
            ]
        );

        if (! (new Authenticator()->attempt($data['email'], $data['password']))) {
            $loginForm->error('email', "No matching account found for this email and password.")->throwException();
        }

        Redirect::to('/home');
    }



    public function destroy(): void
    {
        new Authenticator()->logout();
        Redirect::toLogin();
    }



}