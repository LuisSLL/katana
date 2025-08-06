<?php
// routes/web.php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

$router = app()->getRouter();

// Ruta de inicio (home)
$router->get('/', [HomeController::class, 'index']);

// Ruta de perfil de usuario (ejemplo de parámetro)
$router->get('/user/{id}', [UserController::class, 'showProfile']);

// Rutas de autenticación
$router->get('/login', [LoginController::class, 'showLogin']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Ruta protegida (dashboard)
$router->get('/dashboard', [DashboardController::class, 'index'], ['auth']);


