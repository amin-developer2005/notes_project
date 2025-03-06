<?php

//https://stackoverflow.com/questions/2464983/designing-a-general-database-interface-in-php

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