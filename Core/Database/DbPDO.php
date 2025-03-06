<?php

namespace Core\Database;

use Core\Database\DatabaseFactory;
use PDO;


class DbPDO extends DatabaseFactory
{

    public function connect(): void
    {
        // TODO: Implement connect() method.
        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}";
        $this->connection = new PDO($dsn, $this->username, $this->password, [
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ]);
    }


    public function query(string $sql, array $data = []): static
    {
        // TODO: Implement query() method.
        $this->stmt = $this->connection->prepare($sql);
        $this->stmt->execute($data);

        return $this;
    }



    public function find()
    {
        // TODO: Implement fetch() method.
        return $this->stmt->fetch();
    }


    public function findOrFail()
    {
        // TODO: Implement fetchOrFail() method.
        $result = $this->find();

        if (! $result ) {
            abort();
        }

        return $result;
    }


    public function findAll()
    {
        // TODO: Implement fetchAll() method.
        return $this->stmt->fetchAll();
    }

}