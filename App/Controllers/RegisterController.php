<?php

namespace App\Controllers;

use App\Models\UserModel;
use Core\Authenticator;
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

    private array $fields = [];



    public function __construct()
    {
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

        if (! $this->register()) {
            $this->error('email', 'You already have an account in our website.')->throwException();
        }

        new Authenticator()->login([
            'username' => $this->username,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ]);

        Redirect::to('/home');
    }





    private function register(): bool
    {
        $user = UserModel::fetchUserByEmail($this->email);

        if (! $user) {
            $hashedPassword = generateHashArgon($this->password);
            UserModel::create($this->username, $this->email, $hashedPassword);
            return true;
        }

        return false;
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