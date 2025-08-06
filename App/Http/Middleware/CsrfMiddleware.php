<?php
namespace App\Http\Middleware;

class CsrfMiddleware
{
    /**
     * Ejemplo de middleware CSRF. Aquí deberías validar el token CSRF en formularios POST.
     */
    public function handle(callable $next)
    {
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     // Validar token CSRF aquí
        // }
        $next();
    }
}