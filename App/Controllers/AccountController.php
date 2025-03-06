<?php

namespace App\Controllers;

use App\Models\UserModel;
use Symfony\Component\HttpFoundation\Request;
use Core\Url;
use App\System\Traits\AuthValidator;
use App\View\View;
use Core\Redirect;


#[\AllowDynamicProperties]
class AccountController
{
    use AuthValidator;

    protected array $fields = [];


    public function __construct()
    {
        if (Url::isRequestMethod(Request::METHOD_POST)) {
            if (Url::hasPost('email')) {
                $this->saveFields(Url::fetchPost());
            }
        }
    }


    public function register(): void
    {
        if (Url::isRequestMethod(Request::METHOD_POST) ) {
            if (Url::fetchPost('email')) {
                $this->registerUser();
            }
        }

        $this->renderRegistrationForm();
    }



    private function renderRegistrationForm(): void
    {
        View::render('registration/create');
    }



    private function registerUser(): void
    {
        // Validate the data;
        $this->validate();

        // Check if the validation fails, then display the messages to the user and exit;
//        if (! $this->isValid) {
//            View::render('registration/create', ['heading' => 'Sign Up', 'errors' => $this->messageController->getMessages()]);
//        }

        // Check if the account already exists in the database;
            // If yes, redirect the user to login page;
        $user = UserModel::fetchUserByEmail($this->email);
        if ($user) {
            Redirect::to('/account/login');
        }

        // Hash the user's password
        $hashedPassword = generateHashArgon($this->password);

        // Otherwise save the user information into the database;
        UserModel::create($this->username, $this->email, $hashedPassword);

        // Login the user;
        new SessionController()->login([
            'username' => $this->username,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ]);

        // Redirect to the home page;
        Redirect::to('/home');
    }





    private function saveFields(array $fields): void
    {
        foreach ($fields as $field => $value) {
            $this->fields[$field] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }


    public function __set(string $name, $value): void
    {
        // TODO: Implement __set() method.
        (! isset($this->fields[$name])) ?: $this->fields[$name] = $value;
    }

    public function __get(string $name)
    {
        // TODO: Implement __get() method.
        return $this->fields[$name] ?? null;
    }
}