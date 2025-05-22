<?php
//   Src/Core/DataBase.php

namespace Src\Core;

use PDO;
use PDOException;

class DataBase
{
    protected $pdo;

    public function __construct()
    {
        $config = require __DIR__ . '/../../Config/database.php';

        try {
            $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['database']};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
