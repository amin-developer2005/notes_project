<?php

namespace App\Controllers;

use App\View\View;
use Core\Container;
use Core\Middleware\Middleware;


class RouterController
{
    private Container $container {
        set => $this->container = $value;
        get => $this->container;
    }

    private Middleware $middleware {
        set => $this->middleware = $value;
        get => $this->middleware;
    }

    private array $routes {
        set => $this->routes = $value;
        get => $this->routes;
    }


    
    public function __construct(Container $container, Middleware $middleware)
    {
        $this->container = $container;
        $this->middleware = $middleware;
    }


    public function route(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {

                    if (null !== $middleware = $route['middleware']) {
                        $this->middleware->resolver($middleware);
                    }

                    [$controller, $_method] = $route['class'];
                    call_user_func_array([$controller, $_method], []);
            }
        }

        $this->abort();
    }


    private function add(string $method, string $uri, array $class)
    {
        $this->routes = [
            [
                'uri'           => $uri,
                'class'         => $class,
                'method'        => $method,
                'middleware'    => null,
            ]
        ];

        return $this;
    }


    public function get(string $uri, array $class)
    {
        $this->add('get', $uri, $class);
        return $this;
    }

    public function post(string $uri, array $class) {
        $this->add('post', $uri, $class);
        return $this;
    }


    public function put(string $uri, array $class)
    {
        $this->add('put', $uri, $class);
        return $this;
    }


    public function middleware(string $class)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $class;
    }


    public function hasMiddleware($route)
    {
        if (null !== $route['middleware']) {
            return true;
        }

        return false;
    }


    private function abort($status = 404)
    {
        http_response_code($status);
        View::render("");
    }
}