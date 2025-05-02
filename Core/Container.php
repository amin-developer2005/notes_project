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


namespace Core;

use Core\Interfaces\ContainerInterface;
use http\Exception\RuntimeException;
use ReflectionClass;



class Container implements ContainerInterface
{
    private array $bindings = [];


    public function bind($field, $resolver = null): void
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

        if (array_key_exists($field, $this->bindings)) {
            $resolver = $this->bindings[$field];

            if (null !== $resolver) {
                return call_user_func($resolver);
            }
        }

        return $this->autoResolve($field);
    }


    /**
     * @throws \ReflectionException
     */
    public function autoResolve($class)
    {
        $reflection = new ReflectionClass($class);

        if (! $reflection->isInstantiable()) {
            throw new RuntimeException("The class {$class} is not instantiable");
        }

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return $reflection->newInstanceWithoutConstructor();
        }

        if (! $params = $constructor->getParameters() ?? null) {
            return $reflection->newInstance();
        }

        $dependencies = array_map(function ($param) {
            $type = $param->getType();

            if (! is_null($type)) {
                if (class_exists($type->getName())) {
                    return $this->resolve($type->getName());
                }
            }

            if ($param->isDefaultValueAvailable()) {
                return $param->getDeclaringClass();
            }

            return $param;
        }, $params);

        return $reflection->newInstanceArgs($dependencies);
    }
}