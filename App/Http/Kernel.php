<?php

namespace App\Http;

use Src\Core\Router;

class Kernel
{
    protected Router $router;

    protected array $middleware = [
        // Ejemplo de middleware global
        // \App\Http\Middleware\MaintenanceMiddleware::class,
    ];

    protected array $routeMiddleware = [
        'auth' => \App\Http\Middleware\AuthMiddleware::class,
        // Agrega más middlewares aquí
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
        $routeData = $this->router->dispatch($url);

        if (!$routeData) {
            return;
        }

        $middlewareStack = array_merge(
            $this->middleware, // Globales
            array_map(fn($alias) => $this->resolveMiddleware($alias), $routeData['middleware']) // Por ruta
        );

        // Ejecutar la pila de middleware en cadena
        $handler = function () use ($routeData) {
            $handler = $routeData['handler'];
            $params = $routeData['params'];

            if (is_array($handler)) {
                [$controller, $method] = $handler;
                echo call_user_func_array([new $controller, $method], $params);
            } elseif (is_callable($handler)) {
                echo call_user_func_array($handler, $params);
            }
        };

        $this->runMiddlewareStack($middlewareStack, $handler);
    }

    protected function resolveMiddleware(string $alias)
    {
        if (!isset($this->routeMiddleware[$alias])) {
            throw new \Exception("Middleware '$alias' no está definido.");
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
