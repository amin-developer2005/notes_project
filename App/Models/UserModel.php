<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/22/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace App\Models;

use Core\Database\DatabaseFactory;


class UserModel
{
    /**
     * @throws \Exception
     */
    private static function db()
    {
        return DatabaseFactory::fetchInstance();
    }


    public static function create($username , $email, $password)
    {
        self::db()->query("INSERT INTO users (username, email, PASSWORD, last_seen, created_at) VALUES (:username, :email, :password, :last_seen, :created_at)", [
            ':username' => $username,
            ':email' => $email,
            ':password' => $password,
            ':last_seen' => date('Y-m-d H:i:s'),
            ':created_at' => date('Y-m-d H:i:s'),
        ]);
    }


    public static function fetchUserByEmail($email)
    {
        return self::db()->query("SELECT * FROM users WHERE email=:email", [':email' => $email])->find();
    }
}