<?php

namespace Core;

use Core\Url;
use Core\Redirect;
use Symfony\Component\HttpFoundation\Request;
use App\View\View;
use App\Models\UserModel;
use App\Forms\LoginForm;


class Authenticator
{
    public function attempt($email, $password): bool
    {
        $user = UserModel::fetchUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user->PASSWORD)) {
                $this->login((array)$user);
                return true;
            }
        }

        return false;
    }


    public function login(array $user): void
    {
        $_SESSION['user']['logged_in'] = true;
        foreach ($user as $field => $value) {
            $_SESSION['user'][$field] = $value;
        }

        session_regenerate_id(true);
    }


    public function logout(): void
    {
        Session::destroy();
    }
}