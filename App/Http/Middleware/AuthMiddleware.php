<?php
namespace App\Http\Middleware;

class AuthMiddleware
{
    public function handle(callable $next)
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
        $next();
    }
}

