<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Admin' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .content {
            flex: 1;
            padding: 1rem;
        }
    </style>
</head>
<body>

    <?php partial('sidebar'); ?>

      <div class="main-content" id="mainContent">
        <?php yieldSection('content'); ?>
    </div>


</body>
</html>
