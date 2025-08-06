<!DOCTYPE html>
<html lang="es">
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
</head>
<body>
    <!-- Header con menú de navegación -->
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
                            <a class="nav-link" href="admin">Documentation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register">Registrate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login">Access</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

