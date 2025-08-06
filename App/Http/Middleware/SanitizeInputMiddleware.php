<?php
namespace App\Http\Middleware;

class SanitizeInputMiddleware
{
    /**
     * Ejemplo de middleware para sanitizar entradas globalmente.
     */
    public function handle(callable $next)
    {
        // foreach ($_POST as $k => $v) {
        //     $_POST[$k] = htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
        // }
        $next();
    }
}