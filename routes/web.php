<?php
// routes/web.php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

$router = app()->getRouter();

$router->get('/', function() {
    return view('home');
});

$router->get('/login', [LoginController::class, 'showLogin']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/dashboard', [DashboardController::class, 'index'], ['auth']);


