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

use PDO;


class Database
{

    private PDO $connection;
    private $statement;

    public function __construct()
    {
    }


    public function query(string $sql, array $data = []): static
    {
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute($data);
        return $this;
    }



    public function fetch()
    {
        return $this->statement->fetch();
    }



    public function fetchAll()
    {
        return $this->statement->fetchAll();
    }


    public function fetchAllOrFail()
    {
        $result = $this->statement->fetchAll();

        if (! $result) {
            abort();
        }

        return $result;
    }



    public function fetchOrFail()
    {
        $result = $this->statement->fetch();

        if (! $result) {
            abort();
        }

        return $result;
    }

}