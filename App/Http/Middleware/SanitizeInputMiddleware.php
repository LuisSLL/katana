<?php
namespace App\Http\Middleware;

class SanitizeInputMiddleware
{
    public function handle(callable $next)
    {
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        return $next();
    }
}