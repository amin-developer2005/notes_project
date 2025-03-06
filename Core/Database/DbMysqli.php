<?php

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

    public function fetchOrFail()
    {
        // TODO: Implement fetchOrFail() method.
    }

    public function fetchAll()
    {
        // TODO: Implement fetchAll() method.
    }

    public function fetchAllOrFail()
    {
        // TODO: Implement fetchAllOrFail() method.
    }
}