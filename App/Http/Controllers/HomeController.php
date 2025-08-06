<?php
namespace App\Http\Controllers;

class HomeController
{
    /**
     * Muestra la página de inicio.
     */
    public function index()
    {
        // Aquí podrías cargar datos dinámicos si lo necesitas
        return view('home');
    }
}