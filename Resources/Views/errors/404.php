<!-- Resources/Views/errors/404.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página no encontrada - Error 404</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; text-align: center; padding: 60px; }
        h1 { font-size: 50px; color: #e74c3c; }
        p  { font-size: 18px; color: #555; }
        a  { text-decoration: none; color: #3498db; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Error 404</h1>
    <p>La página que estás buscando no existe.</p>
    <p><a href="<?= url('/') ?>">Volver al inicio</a></p>
</body>
</html>
