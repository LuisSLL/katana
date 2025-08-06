<?php
// Src/Helpers/functions.php

// ----------------------------------------------
// REDIRECCIÓN
// ----------------------------------------------

if (!function_exists('redirect')) {
    /**
     * Redirecciona a una ruta interna usando la función `url()` como base.
     * Ejemplo: redirect('/login') → http://localhost/katana/public/login
     *
     * @param string $path Ruta relativa o absoluta.
     */
    function redirect($path)
    {
        // Si la ruta ya es absoluta (http/https), no la modifica
        if (preg_match('#^https?://#', $path)) {
            header("Location: $path");
        } else {
            header("Location: " . url($path));
        }
        exit;
    }
}

// ----------------------------------------------
// URL ACTUAL
// ----------------------------------------------

if (!function_exists('current_url')) {
    /**
     * Retorna la URL completa del request actual (protocolo + host + ruta)
     * Ejemplo: https://localhost/katana/public/login
     *
     * @return string
     */
    function current_url()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
        return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}

// ----------------------------------------------
// FUNCIONES DE ENTORNO
// ----------------------------------------------

if (!function_exists('env')) {
    /**
     * Obtiene una variable del entorno cargada desde .env
     * Si no existe, retorna el valor por defecto.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function env(string $key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}

// ----------------------------------------------
// ERRORES
// ----------------------------------------------

/**
 * Muestra u oculta errores de PHP según el valor booleano dado.
 * Útil para controlar entornos: desarrollo vs producción.
 *
 * @param bool $display
 */
function show_errors(bool $display = true): void
{
    ini_set('display_errors', $display ? '1' : '0');
    ini_set('display_startup_errors', $display ? '1' : '0');
    error_reporting($display ? E_ALL : 0);
}

// ----------------------------------------------
// DEBUG
// ----------------------------------------------

/**
 * Muestra datos con formato legible si APP_DEBUG es true en .env
 *
 * @param mixed $data
 */
function debug($data): void
{
    if (env('APP_DEBUG') === 'true') {
        echo '<pre style="background:#111;color:#0f0;padding:10px;border-radius:6px">';
        print_r($data);
        echo '</pre>';
    }
}

// ----------------------------------------------
// ASSET (Archivos públicos)
// ----------------------------------------------

/**
 * Retorna la ruta absoluta a un archivo dentro de /public
 * Ejemplo: asset('css/app.css') → http://localhost/proyecto/public/css/app.css
 *
 * @param string $path
 * @return string
 */
function asset(string $path = ''): string
{
    return url('/') . '/' . ltrim($path, '/');
}

// ----------------------------------------------
// URL ABSOLUTA DINÁMICA
// ----------------------------------------------

/**
 * Retorna una URL absoluta desde la raíz del proyecto.
 * Si APP_ENV=production y APP_URL está definido, lo usa.
 * Si no, detecta automáticamente el dominio y subcarpeta actual.
 *
 * @param string $path Ruta adicional (opcional).
 * @return string
 */
function url(string $path = ''): string
{
    $isProduction = env('APP_ENV') === 'production';
    if ($isProduction && !empty($_ENV['APP_URL'])) {
        $base = rtrim($_ENV['APP_URL'], '/');
    } else {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        // Detecta subcarpeta si existe (ej: /katana/public o /katana)
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $basePath = str_replace('/index.php', '', $scriptName);
        // Si estamos en /public, quitarlo para obtener la base real
        $basePath = preg_replace('#/public$#', '', $basePath);
        $base = $protocol . $host . $basePath;
    }
    return rtrim($base, '/') . '/' . ltrim($path, '/');
}

// ----------------------------------------------
// BASE URL DEL SITIO (APP_URL sin path adicional)
// ----------------------------------------------

if (!function_exists('base_url')) {
    /**
     * Retorna la URL base del sitio sin agregar paths adicionales.
     * Usa APP_URL si está definido en producción.
     * Detecta automáticamente en desarrollo.
     *
     * @return string
     */
    function base_url(): string
    {
        $isProduction = env('APP_ENV') === 'production';

        if ($isProduction && !empty($_ENV['APP_URL'])) {
            return rtrim($_ENV['APP_URL'], '/');
        }

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $script = $_SERVER['SCRIPT_NAME'] ?? '';
        $basePath = rtrim(str_replace('/index.php', '', $script), '/');

        return $protocol . $host . $basePath;
    }
}

// ----------------------------------------------
// BASE PATH DEL PROYECTO
// ----------------------------------------------

if (!function_exists('base_path')) {
    /**
     * Retorna la ruta absoluta del proyecto (directorio raíz).
     * Útil para acceder a archivos internos desde cualquier punto.
     *
     * @param string $path Ruta interna opcional a agregar
     * @return string
     */
    function base_path(string $path = ''): string
    {
        return realpath(__DIR__ . '/../../') . ($path ? DIRECTORY_SEPARATOR . ltrim($path, '/\\') : '');
    }
}

// ----------------------------------------------
// MANEJADOR GLOBAL DE EXCEPCIONES
// ----------------------------------------------

set_exception_handler(function ($e) {
    http_response_code(500);

    // Registrar error en logs
    file_put_contents(
        base_path('storage/logs/error.log'),
        $e->getMessage() . "\n" . $e->getTraceAsString() . "\n\n",
        FILE_APPEND
    );

    // Mostrar error solo si está APP_DEBUG habilitado
    if (env('APP_DEBUG') === 'true') {
        echo "<h2 style='color:red'>Error: {$e->getMessage()}</h2>";
        echo "<pre>{$e->getTraceAsString()}</pre>";
    } else {
        // Cargar vista personalizada 500 si existe
        $errorView = base_path('Resources/Views/errors/500.php');
        if (file_exists($errorView)) {
            require $errorView;
        } else {
            echo "500 Error Interno del Servidor";
        }
    }

    exit;
});
