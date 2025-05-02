<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/19/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace App\Services;

use Core\Url;
use Core\Redirect;
use http\Client\Curl\User;
use Symfony\Component\HttpFoundation\Request;
use App\View\View;
use App\Models\UserModel;
use App\Forms\LoginForm;


class AuthenticationService
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


    public function register(array $info)
    {
        $user = UserModel::fetchUserByEmail($info['email']);

        if (! $user) {
            $hashedPassword = generateHashArgon($info['password']);
            UserModel::create($info['username'], $info['email'], $hashedPassword);

            return true;
        }

        return false;
    }
    
    
    

    public function logout(): void
    {
        Session::destroy();
    }
}