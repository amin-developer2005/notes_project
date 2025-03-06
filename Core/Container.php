<?php

namespace Core;

use Core\Interfaces\ContainerInterface;


class Container implements ContainerInterface
{
    private array $bindings = [];


    public function bind($field, $resolver): void
    {
        // TODO: Implement bind() method.
        $this->bindings[$field] = $resolver;
    }


    /**
     * @throws \Exception
     */
    public function resolve($field): object
    {
        // TODO: Implement resolve() method.
        if (! array_key_exists($field, $this->bindings)) {
            throw new \Exception("Resolve value not found for {$field}");
        }

        $resolver = $this->bindings[$field];
        return call_user_func($resolver);
    }
}