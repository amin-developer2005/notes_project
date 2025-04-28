<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 3/2/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace Core\Interfaces;

interface ContainerInterface
{
    public function bind($field, $resolver): void;
    public function resolve($field): object;
}