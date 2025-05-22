<?php
//    Src/Helpers/functions.php

// Mostrar errores siempre en entorno local
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
