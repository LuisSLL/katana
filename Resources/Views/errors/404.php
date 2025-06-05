<?php

namespace Src\Core;

class Router
{
    protected $routes = [];

    public function get($uri, $action)
    {
        return $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action)
    {
        return $this->addRoute('POST', $uri, $action);
    }

    protected function addRoute($method, $uri, $action)
    {
        $uri = '/' . trim($uri, '/');

        $regex = preg_replace(
            '/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/',
            '(?P<$1>[^/]+)',
            $uri
        );

        $regex = '#^' . $regex . '$#';

        // Creamos un objeto de ruta y devolvemos una instancia para poder encadenar ->middleware()
        $route = [
            'uri'        => $uri,
            'regex'      => $regex,
            'action'     => $action,
            'middleware' => [],
        ];

        $this->routes[$method][] = &$route;

        return new class($route) {
            protected $route;

            public function __construct(&$route)
            {
                $this->route = &$route; // Referencia al array original
            }

            public function middleware($middleware)
            {
                $this->route['middleware'] = is_array($middleware)
                    ? $middleware
                    : [$middleware];
                return $this;
            }
        };
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
                return [
                    'handler'    => $route['action'],
                    'params'     => $params,
                    'middleware' => $route['middleware'] ?? []
                ];
            }
        }

        http_response_code(404);
        $errorView = __DIR__ . '/../../Resources/Views/errors/404.php';

        if (file_exists($errorView)) {
            require $errorView;
        } else {
            echo "404 Not Found";
        }

        return null;
    }
}
