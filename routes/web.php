<?php
// routes/web.php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;



// Obtener la instancia del router desde el Kernel
$router = app()->getRouter();

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

// Página de inicio
$router->get('/', [HomeController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);

// Mostrar formulario de login
$router->get('/login', [AuthController::class, 'showLogin']);
// Procesar login
$router->post('/login', [AuthController::class, 'login']);

// Mostrar formulario de registro
$router->get('/register', [AuthController::class, 'showRegister']);
// Procesar registro
$router->post('/register', [AuthController::class, 'register']);

// Cerrar sesión
$router->get('/logout', [AuthController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| Rutas protegidas (futuro middleware para proteger)
|--------------------------------------------------------------------------
*/

// Panel de administración (requiere estar logueado en el futuro)
$router->get('/admin', [AdminController::class, 'index']);
$router->get('/post/{id}', [PostController::class, 'show']);
