<?php
// katana/Src/Console/Migrator.php

namespace Src\Console;

class Migrator
{
    protected string $migrationsPath;

    public function __construct(string $path = null)
    {
        $this->migrationsPath = $path ?? base_path('migrations');
    }

    public function migrate(): void
    {
        echo "🔍 Buscando migraciones en: {$this->migrationsPath}" . PHP_EOL;

        if (!is_dir($this->migrationsPath)) {
            echo "❌ No existe la carpeta de migraciones." . PHP_EOL;
            return;
        }

        $files = glob($this->migrationsPath . '/*.php');
        sort($files);

        if (empty($files)) {
            echo "📭 No hay migraciones por ejecutar." . PHP_EOL;
            return;
        }

        foreach ($files as $file) {
            require_once $file;

            $className = $this->getClassNameFromFile($file);

            if (!class_exists($className)) {
                echo "⚠️  Clase $className no encontrada en $file" . PHP_EOL;
                continue;
            }

            echo "🚀 Ejecutando migración: $className" . PHP_EOL;

            $migration = new $className();

            if (!method_exists($migration, 'up')) {
                echo "⚠️  La migración $className no tiene método up()." . PHP_EOL;
                continue;
            }

            $migration->up();

            $this->markAsMigrated($file);

            echo "✅ Migración ejecutada correctamente." . PHP_EOL;
        }

        echo "✅ Todas las migraciones ejecutadas." . PHP_EOL;
    }

    public function rollback(): void
    {
        $migratedFile = $this->migrationsPath . '/.migrated';

        if (!file_exists($migratedFile)) {
            echo "📭 No hay migraciones registradas para revertir." . PHP_EOL;
            return;
        }

        $migrated = array_filter(array_map('trim', file($migratedFile)));

        if (empty($migrated)) {
            echo "📭 Lista de migraciones ya está vacía." . PHP_EOL;
            return;
        }

        $lastMigration = array_pop($migrated); // última ejecutada
        $filePath = $this->migrationsPath . '/' . $lastMigration;

        if (!file_exists($filePath)) {
            echo "⚠️  El archivo de migración $lastMigration no existe." . PHP_EOL;
            return;
        }

        require_once $filePath;

        $className = $this->getClassNameFromFile($filePath);

        if (!class_exists($className)) {
            echo "⚠️  Clase $className no encontrada." . PHP_EOL;
            return;
        }

        echo "⏪ Revirtiendo migración: $className" . PHP_EOL;

        $migration = new $className();

        if (!method_exists($migration, 'down')) {
            echo "⚠️  La migración $className no tiene método down()." . PHP_EOL;
            return;
        }

        $migration->down();

        // Guardar el archivo .migrated actualizado
        file_put_contents($migratedFile, implode(PHP_EOL, $migrated) . PHP_EOL);

        echo "✅ Migración revertida correctamente." . PHP_EOL;
    }

    protected function markAsMigrated(string $file): void
    {
        file_put_contents(
            $this->migrationsPath . '/.migrated',
            basename($file) . PHP_EOL,
            FILE_APPEND
        );
    }

    protected function getClassNameFromFile(string $file): string
    {
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $parts = explode('_', $filename);
        $parts = array_slice($parts, 4);
        $classBase = str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', implode('_', $parts))));
        return 'Migrations\\' . $classBase;
    }
}
