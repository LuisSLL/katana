<?php
// routes/web.php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


// Obtener la instancia del router desde el Kernel
$router = app()->getRouter();

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
$router->get('/', [HomeController::class, 'index']);
$router->get('/home', [HomeController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Rutas de Usuario
|--------------------------------------------------------------------------
*/
$router->get('/user/{id}', [UserController::class, 'showProfile']); // 👈 Nueva ruta

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'showRegister']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout']);
$router->get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'], ['auth']);


