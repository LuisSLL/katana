<?php
// katana/Src/Console/MigrationCreator.php

namespace Src\Console;

class MigrationCreator
{
    protected $migrationsPath;

    public function __construct()
    {
        $this->migrationsPath = base_path('migrations');
    }

    public function create($name)
    {
        $timestamp = date('Y_m_d_His');
        $fileName = "{$timestamp}_{$name}.php";
        $filePath = $this->migrationsPath . '/' . $fileName;

        $className = $this->toClassName($name);

        $stub = <<<PHP
<?php

namespace Migrations;

class {$className}
{
    public function up()
    {
        return "
            -- Escribe tu SQL aquí, por ejemplo:
            -- CREATE TABLE users (
            --     id INT AUTO_INCREMENT PRIMARY KEY,
            --     name VARCHAR(100),
            --     email VARCHAR(100),
            --     password VARCHAR(255),
            --     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            -- );
        ";
    }

    public function down()
    {
        return "
            -- DROP TABLE IF EXISTS users;
        ";
    }
}
PHP;

        if (!file_exists($this->migrationsPath)) {
            mkdir($this->migrationsPath, 0777, true);
        }

        file_put_contents($filePath, $stub);

        echo "✅ Migración creada: migrations/{$fileName}\n";
    }

    protected function toClassName($name)
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $name)));
    }
}
