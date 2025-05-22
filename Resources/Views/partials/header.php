<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'katana' ?></title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Meta descripción -->
    <meta name="description" content="Descripción predeterminada del sitio">
    <style>
        /* Solo esto es necesario para el dark mode */
        body.dark-mode {
            background-color: #121212;
            color: #f8f9fa;
        }
        .dark-mode .navbar {
            background-color: #1a1a1a !important;
        }
        .dark-mode .card {
            background-color: #1e1e1e;
            border-color: #333;
        }
    </style>
</head>
<body>
    <!-- Header con menú de navegación y dark mode -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="/">katana</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Documentation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Access</a>
                        </li>
                        <li class="nav-item ms-2">
                            <div class="form-check form-switch d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" id="darkModeSwitch">
                                <label class="form-check-label ms-2 text-white" for="darkModeSwitch">
                                    <i class="bi bi-moon-fill"></i>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

