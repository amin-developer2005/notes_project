<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/10/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace Core\Database;

use Core\Database\DatabaseFactory;

class DbMysqli extends DatabaseFactory
{

    public function connect()
    {
        // TODO: Implement connect() method.

    }

    public function query(string $sql, array $data = [])
    {
        // TODO: Implement query() method.
    }

    public function fetch()
    {
        // TODO: Implement fetch() method.
    }


    public function find()
    {
        // TODO: Implement find() method.
    }

    public function findOrFail()
    {
        // TODO: Implement findOrFail() method.
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }
}