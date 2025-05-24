<?php
// bootstrap/app.php
// Mostrar errores siempre en desarrollo

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definir entorno
define('ENVIRONMENT', 'development');

// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Helpers
require_once __DIR__ . '/../Src/Helpers/functions.php';
require_once __DIR__ . '/../Src/Helpers/ViewHelpers.php';

// Cargar archivo .env   
// Función env()
if (!function_exists('env')) {
    function env($key, $default = null) {
        return $_ENV[$key] ?? $default;
    }
}

// Mostrar errores según .env
show_errors(env('APP_DEBUG') === 'true');

// Cargar Kernel
$kernelPath = __DIR__ . '/../App/Http/Kernel.php';

if (!file_exists($kernelPath)) {
    die("Archivo kernel.php no encontrado en: $kernelPath");
}

require_once $kernelPath;

use App\Http\Kernel;

// Instancia global del Kernel
$kernel = new Kernel();

function app() {
    global $kernel;
    return $kernel;
}

// Cargar rutas
require_once __DIR__ . '/../routes/web.php';

// Manejo de errores (500)
set_exception_handler(function ($exception) {
    http_response_code(500);
    $errorView = __DIR__ . '/../Resources/Views/errors/500.php';

    if (file_exists($errorView)) {
        require $errorView;
    } else {
        echo "<h1>Error 500</h1><p>{$exception->getMessage()}</p>";
    }
});

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    http_response_code(500);
    $errorView = __DIR__ . '/../Resources/Views/errors/500.php';

    if (file_exists($errorView)) {
        require $errorView;
    } else {
        echo "<h1>Error 500</h1><p>$errstr in $errfile on line $errline</p>";
    }
});
