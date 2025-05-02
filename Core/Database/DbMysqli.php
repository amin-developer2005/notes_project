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
use mysqli;

class DbMysqli extends DatabaseFactory
{

    public function connect()
    {
        // TODO: Implement connect() method.
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname, $this->port);

        if ($this->connection->connect_error) {
            echo "Mysqli Connection Failed due to: {$this->connection->connect_error}. Error Code => {$this->connection->connect_errno}";
            exit;
        }

        $this->connection->query("SET NAMES 'utf-8");
    }



    public function query(string $sql, array $data = [])
    {
        // TODO: Implement query() method.
        $result = $this->connection->query($sql);

        if ($result->num_rows == 0) {
            return null;
        }

        $records = [];

        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $result->free();
        return $records;
    }



    public function first(string $sql, array $data = [])
    {
        $records = $this->query($sql, $data);

        if (null == $records) {
            return null;
        }

        return $records[0];
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

    public function close()
    {
        // TODO: Implement close() method.
        $this->connection->close();
    }
}