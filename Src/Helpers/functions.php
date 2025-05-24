<?php
//    Src/Helpers/functions.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
// Mostrar errores siempre en entorno local

// Redireccionar a una URL
if (!function_exists('redirect')) {
    function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}

// Obtener la URL actual
if (!function_exists('current_url')) {
    function current_url()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
        return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}



// Acceso global al Kernel
if (!function_exists('app')) {
    function app()
    {
        global $kernel;
        return $kernel;
    }
}


/**
 * Mostrar u ocultar errores según entorno
 */
function show_errors(bool $display = true): void
{
    ini_set('display_errors', $display ? '1' : '0');
    ini_set('display_startup_errors', $display ? '1' : '0');
    error_reporting($display ? E_ALL : 0);
}

/**
 * Debug fácil de leer (solo si APP_DEBUG = true)
 */
function debug($data): void
{
    if (env('APP_DEBUG') === 'true') {
        echo '<pre style="background:#111;color:#0f0;padding:10px;border-radius:6px">';
        print_r($data);
        echo '</pre>';
    }
}

/**
 * Ruta absoluta desde la raíz pública
 */
function asset(string $path = ''): string
{
    return url('/') . '/' . ltrim($path, '/');
}

/**
 * Retorna una URL absoluta desde la raíz
 */
function url(string $path = ''): string
{
    $base = $_ENV['APP_URL'] ?? 'http://localhost';
    return rtrim($base, '/') . '/' . ltrim($path, '/');
}
