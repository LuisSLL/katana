<?php
// App/Http/Kernel.php

namespace App\Http;

use Src\Core\Router;
use Exception;

class Kernel
{
    protected Router $router;

    protected array $middleware = [
        \App\Http\Middleware\MaintenanceMiddleware::class,
        \App\Http\Middleware\SanitizeInputMiddleware::class,
        \App\Http\Middleware\CorsMiddleware::class,
    ];

    protected array $routeMiddleware = [
        'auth' => \App\Http\Middleware\AuthMiddleware::class,
    ];

    public function __construct()
    {
        $this->router = new Router();
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function handle(string $url)
    {
        try {
            $routeData = $this->router->dispatch($url);

            if (!$routeData) {
                http_response_code(404);
                return view('errors/404');
            }

            $middlewareStack = array_merge(
                $this->middleware,
                array_map(
                    fn($alias) => $this->resolveMiddleware($alias),
                    $routeData['middleware']
                )
            );

            $handler = function () use ($routeData) {
                $handler = $routeData['handler'];
                $params = $routeData['params'];

                if (is_array($handler)) {
                    [$controller, $method] = $handler;

                    if (!class_exists($controller)) {
                        throw new Exception("Clase $controller no existe");
                    }

                    if (!method_exists($controller, $method)) {
                        throw new Exception("Método $method no existe en $controller");
                    }

                    echo call_user_func_array([new $controller, $method], $params);
                } elseif (is_callable($handler)) {
                    echo call_user_func_array($handler, $params);
                } else {
                    throw new Exception("Handler inválido");
                }
            };

            $this->runMiddlewareStack($middlewareStack, $handler);

        } catch (Exception $e) {
            http_response_code(500);
            exit;
        }
    }

    protected function resolveMiddleware(string $alias)
    {
        if (!isset($this->routeMiddleware[$alias])) {
            throw new Exception("Middleware '$alias' no está definido.");
        }

        return $this->routeMiddleware[$alias];
    }

    protected function runMiddlewareStack(array $middlewareStack, callable $handler)
    {
        $pipeline = array_reduce(
            array_reverse($middlewareStack),
            function ($next, $middlewareClass) {
                return function () use ($middlewareClass, $next) {
                    $middleware = new $middlewareClass();
                    $middleware->handle($next);
                };
            },
            $handler
        );

        $pipeline();
    }
}
