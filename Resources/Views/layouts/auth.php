<!-- resources/views/layout/auth.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katana | <?= $title ?? 'Acceso' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .auth-wrapper { height: 100vh; background: #f8f9fa; }
        .auth-card { width: 100%; max-width: 400px; border: none; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="auth-wrapper d-flex align-items-center justify-content-center">
        <div class="auth-card card p-4">
            <?php yieldSection('content'); ?> <!-- Cambiamos $content por yieldSection -->
        </div>
    </div>
</body>
</html>