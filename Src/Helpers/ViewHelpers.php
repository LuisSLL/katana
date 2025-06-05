<?php
//    Src/Helpers/ViewHelpers.php
use Src\Core\View;
// Helper global de vista (usa la clase View)
if (!function_exists('view')) {
    function view($view, $data = [])
    {
        return View::render($view, $data);
    }
}

// Sistema de layout Blade-like

if (!function_exists('layout')) {
    function layout($name)
    {
        View::setLayout($name);
    }
}

if (!function_exists('section')) {
    function section($name)
    {
        View::startSection($name);
    }
}

if (!function_exists('endSection')) {
    function endSection()
    {
        View::endSection();
    }
}

if (!function_exists('yieldSection')) {
    function yieldSection($name)
    {
        echo View::getSection($name);
    }
}


if (!function_exists('partial')) {
    function partial($name, $data = [])
    {
        $path = __DIR__ . '/../../Resources/Views/partials/' . $name . '.php';

        if (file_exists($path)) {
            extract($data);
            require $path;
        } else {
            echo "<!-- Parcial '$name' no encontrado -->";
        }
    }
}
