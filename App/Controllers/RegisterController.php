<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/17/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace App\Controllers;

use App\Services\AuthenticationService;
use Core\Session;
use Core\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Core\Url;
use App\System\Traits\AuthValidator;
use App\View\View;
use Core\Redirect;




#[\AllowDynamicProperties]
class RegisterController
{
    use AuthValidator;

    private AuthenticationService $authenticationService {
        set => $this->authenticationService = $value;
        get => $this->authenticationService;
    }


    private array $fields = [];





    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;

        if (Url::isRequestMethod(Request::METHOD_POST)) {
            if (Url::hasPost('email')) {
                $this->setFields(Url::fetchPost());
            }
        }
    }


    public function create(): void
    {
        View::render('registration/create', ['heading' => 'Sign Up to your account', 'errors' => Session::fetchFlash('errors')]);
    }


    /**
     * @throws ValidationException
     */
    public function store(): void
    {
        $this->validate();

        if (! $this->authenticationService->register($info = [
            'username'   => $this->username,
            'email'      => $this->email,
            'mobile'     => $this->mobile,
        ])) {
            $this->error('email', 'You already have an account in our website.')->throwException();
        }

        $this->authenticationService->login($info);

        Redirect::to('/home');
    }



    private function setFields(array $fields): void
    {
        foreach ($fields as $field => $value) {
            $this->fields[$field] = $value;
        }
    }



    public function __set(string $name, $value): void
    {
        // TODO: Implement __set() method.
        (! isset($this->fields[$name])) ?: $this->fields[$name] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public function __get(string $name)
    {
        // TODO: Implement __get() method.
        return $this->fields[$name] ?? null;
    }



}