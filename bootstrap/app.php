<?php
// bootstrap/app.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir entorno
define('ENVIRONMENT', 'development');

// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Cargar variables .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Helpers
require_once __DIR__ . '/../Src/Helpers/functions.php';
require_once __DIR__ . '/../Src/Helpers/ViewHelpers.php';

// Configuración de errores
show_errors(env('APP_DEBUG') === 'true');

// Cargar Kernel
$kernelPath = __DIR__ . '/../App/Http/Kernel.php';
if (!file_exists($kernelPath)) {
    die("Archivo kernel.php no encontrado en: $kernelPath");
}
require_once $kernelPath;

use App\Http\Kernel;
$kernel = new Kernel();

function app() {
    global $kernel;
    return $kernel;
}

// Cargar rutas
require_once __DIR__ . '/../routes/web.php';

// Manejo de errores
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