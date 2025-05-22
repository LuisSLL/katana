<?php

namespace Src\Core;

class Router
{
    protected $routes = [];

    public function get($uri, $action)
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->addRoute('POST', $uri, $action);
    }

    protected function addRoute($method, $uri, $action)
    {
        $uri = '/' . trim($uri, '/');

        // Convertimos {param} en una expresión regular
        $regex = preg_replace('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', '(?P<$1>[^/]+)', $uri);
        $regex = '#^' . $regex . '$#';

        $this->routes[$method][] = [
            'uri' => $uri,
            'regex' => $regex,
            'action' => $action,
        ];
    }

    public function dispatch($uri)
    {
        $uri = '/' . trim($uri, '/');
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method])) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        foreach ($this->routes[$method] as $route) {
            if (preg_match($route['regex'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $handler = $route['action'];

                if (is_array($handler)) {
                    [$controller, $methodName] = $handler;
                    $response = call_user_func_array([new $controller, $methodName], $params);
                } elseif (is_callable($handler)) {
                    $response = call_user_func_array($handler, $params);
                }

                if (isset($response) && is_string($response)) {
                    echo $response;
                }

                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
