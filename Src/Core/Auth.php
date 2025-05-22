<?php
//    /Src/Core/Auth.php
namespace Src\Core;
use App\Models\User;

class Auth
{
    protected static $user;

    // Verifica si hay un usuario autenticado
    public static function check(): bool
    {
        return isset($_SESSION['user_id']);
    }

    // Obtiene el usuario autenticado
    public static function user()
    {
        if (!self::check()) {
            return null;
        }

        if (!self::$user) {
            self::$user = User::find($_SESSION['user_id']);
        }

        return self::$user;
    }

    // Intenta autenticar un usuario con email y contraseña
    public static function attempt($email, $password): bool
    {
        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        $_SESSION['user_id'] = $user['id'];
        return true;
    }

    // Cierra la sesión
    public static function logout()
    {
        unset($_SESSION['user_id']);
        self::$user = null;
    }
}
