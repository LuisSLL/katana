<?php
// Src/Core/Database.php

namespace Src\Core;

use PDO;
use PDOException;

class Database
{
    private static ?self $instance = null;
    protected PDO $pdo;

    private function __construct()
    {
        

        $config = require __DIR__ . '/../../Config/database.php';

        try {   
            $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['database']};charset=utf8mb4";

            $this->pdo = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

         
        } catch (PDOException $e) {
            throw new \RuntimeException("Error de conexión: " . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
