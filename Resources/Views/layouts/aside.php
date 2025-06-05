<!DOCTYPE html>
<html>
<head>
    <title>Panel de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <aside class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
            <h4>Menú</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="/dashboard">Inicio</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="<?= url('logout') ?>">Cerrar sesión</a></li>
            </ul>
        </aside>
        <main class="p-4 flex-grow-1">
            <?php yieldSection('content'); ?>
        </main>
    </div>
</body>
</html>
