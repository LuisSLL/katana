<?php 
// public/index.php

// --------------------------------------------
// MOSTRAR ERRORES SI ESTÁ EN MODO DEBUG
// --------------------------------------------

require_once __DIR__ . '/../Src/Helpers/functions.php';
require_once __DIR__ . '/../Src/Helpers/viewHelpers.php';

// --------------------------------------------
// CARGAR .env (si no lo hiciste en bootstrap/app.php)
// --------------------------------------------

$dotenv = __DIR__ . '/../.env';
if (file_exists($dotenv)) {
    foreach (file($dotenv) as $line) {
        if (trim($line) && strpos(trim($line), '#') !== 0 && strpos($line, '=') !== false) {
            [$name, $value] = explode('=', trim($line), 2);
            $_ENV[$name] = $value;
        }
    }
}

// Mostrar errores si APP_DEBUG=true
show_errors(env('APP_DEBUG') === 'true');

// --------------------------------------------
// CARGAR EL BOOTSTRAP DEL FRAMEWORK
// --------------------------------------------

require_once __DIR__ . '/../bootstrap/app.php';




app()->handle($_GET['url'] ?? '/');






