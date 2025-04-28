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

interface DatabaseInterface
{
    public function connect();
    public function query(string $sql, array $data = []);
    public function find();
    public function findOrFail();
    public function findAll();

}