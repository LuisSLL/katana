<?php
namespace App\Http\Middleware;

class AuthMiddleware
{
    public function handle(callable $next)
    {
        if (!isset($_SESSION['user'])) {
            redirect('/login');
        }

        $next();
    }
}

