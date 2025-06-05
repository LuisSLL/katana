<?php
// katana/cli/artisan.php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../bootstrap/app.php';

use Src\Console\MigrationCreator;
use Src\Console\Migrator;

try {
    $argv = $_SERVER['argv'] ?? [];
    $command = $argv[1] ?? null;
    $argument = $argv[2] ?? null;

    switch ($command) {
        case 'make:migration':
            if (!$argument) {
                echo "❌ Falta el nombre de la migración.\n";
                exit;
            }
            (new MigrationCreator())->create($argument);
            echo "✅ Migración '$argument' creada correctamente.\n";
            break;

        case 'migrate':
            (new Migrator())->migrate();
            echo "✅ Migraciones ejecutadas correctamente.\n";
            break;

        case 'migrate:rollback':
            (new Migrator())->rollback();
            echo "✅ Rollback ejecutado correctamente.\n";
            break;

        default:
            echo "Comando no reconocido. Usa:\n";
            echo "  php cli/artisan.php make:migration NombreDeLaMigracion\n";
            echo "  php cli/artisan.php migrate\n";
            echo "  php cli/artisan.php migrate:rollback\n";
            break;
    }

} catch (Throwable $e) {
    echo "🛑 Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
    exit(1);
}
