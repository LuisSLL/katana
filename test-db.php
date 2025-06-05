<?php
 try {
            echo "<pre>DEBUG DB Config:\n" . print_r($config, true) . "</pre>";
            $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['database']};charset=utf8mb4";
            echo "<pre>DEBUG DSN: $dsn</pre>";
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            throw new \RuntimeException("Error de conexión: " . $e->getMessage());

        } 

