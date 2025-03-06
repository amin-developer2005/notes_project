<?php

namespace Core\Database;

interface DatabaseInterface
{
    public function connect();
    public function query(string $sql, array $data = []);
    public function find();
    public function findOrFail();
    public function findAll();

}