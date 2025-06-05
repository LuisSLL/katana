<?php
namespace App\Http\Middleware;

class CorsMiddleware
{
    public function handle(callable $next)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        return $next(); // ✅ IMPORTANTE: return aquí también
    }
}
