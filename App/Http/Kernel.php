<?php


// App/Http/kernel.php

namespace App\Http;
use Src\Core\Router;

class Kernel
{
    protected Router $router;

    public function __construct()
    {
        // Inicializar el enrutador de la app
        $this->router = new Router();
    }

    //Retorna la instancia del enrutador.
     
    public function getRouter(): Router
    {
        return $this->router;
    }

    //Ejecutar la solicitud
     
    public function handle(string $url)
    {
        $this->router->dispatch($url);
    }
}
