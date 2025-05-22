<?php
// katana/App/Models/User.php

namespace App\Models;

use Src\Core\DataBase;
use PDO;

class User
{
    protected static function db()
    {
        $database = new DataBase();
        return $database->getConnection();
    }

    public static function find($id)
    {
        $stmt = self::db()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function findByEmail($email)
    {
        $stmt = self::db()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public static function create($data)
    {
        $stmt = self::db()->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }
}
