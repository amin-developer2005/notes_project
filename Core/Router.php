<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;
use JetBrains\PhpStorm\NoReturn;
use App\View\View;

class Router
{
    private array $routes = [];


    /**
     * @throws \Exception
     */
    public function route($uri, $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                $controller = $route['controller'][0];
                $method = $route['controller'][1];
                $controllerInstance = new $controller();

                if (null !== $middleware = $route['middleware']) {
                    Middleware::resolve($middleware);
                }

                call_user_func_array([$controllerInstance, $method], []);

            }
        }


        $this->abort();
    }





    public function add(string $method, string $uri, array $controller): static
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'controller' => $controller,
            'middleware' => null,
        ];

        return $this;
    }



    public function get(string $uri, array $controller): static
    {
        return $this->add('get', $uri, $controller);
    }


    public function post(string $uri, array $controller): static
    {
        return $this->add('post', $uri, $controller);
    }



    public function patch(string $uri, array $controller): static
    {
        return $this->add('patch', $uri, $controller);
    }



    public function put(string $uri, array $controller): static
    {
        return $this->add('put', $uri, $controller);
    }



    public function delete(string $uri, array $controller): static
    {
        return $this->add('delete', $uri, $controller);
    }



    public function only($field): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $field;
        return $this;
    }





    public function middleware($name)
    {
        if (null !== $middleware = $this->routes['middleware']) {
            if ($middleware === $name) {

                match ($name) {
                    'auth' => new Auth()->handle(),
                    'guest' => new Guest()->handle(),
                };

            }
        }
    }



    #[NoReturn] private function abort($code = Response::NOTFOUND): void
    {
        http_response_code($code);
        View::render("$code", ['heading' => '403 Forbidden']);
        die();
    }


    public function goBack()
    {
        Redirect::to(Url::fetchRequestMethod(), true);
    }





    public function createRoute($methods, $uri, $action)
    {
            if ($this->actionReferencesController($action)) {
                $this->converActionToController($action);
            }
    }


    private function actionReferencesController($action): bool
    {
        if (! $action instanceof \Closure) {
            return is_array($action);
        }

        return false;
    }


    private function converActionToController($action): array
    {
        $data = [];

        if (is_array($action)) {
            $data = ['controller' => $action[0], 'method' => $action[1]];
        } else {
            $data['controller'] = $action;
        }

        return $data;
    }

}