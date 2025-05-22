<?php

// Mostrar errores siempre en desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definir entorno
define('ENVIRONMENT', 'development');

// Autoload de Composer (si llegas a usarlo en el futuro)
require_once __DIR__ . '/../vendor/autoload.php';

// Cargar helpers
require_once __DIR__ . '/../Src/Helpers/functions.php';
require_once __DIR__ . '/../Src/Helpers/ViewHelpers.php'; 

// Cargar Kernel
$kernelPath = __DIR__ . '/../App/Http/Kernel.php';

if (!file_exists($kernelPath)) {
    die("Archivo kernel.php no encontrado en: $kernelPath");
}

require_once $kernelPath;

use App\Http\Kernel;

// Instancia global del Kernel
$kernel = new Kernel();

// Función global para acceder al Kernel
function app() {
    global $kernel;
    return $kernel;
}

// Cargar rutas
require_once __DIR__ . '/../routes/web.php';
