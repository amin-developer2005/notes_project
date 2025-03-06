<?php

namespace Core\Interfaces;

interface ContainerInterface
{
    public function bind($field, $resolver): void;
    public function resolve($field): object;
}