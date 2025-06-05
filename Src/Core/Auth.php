<?php
// Src/Core/Auth.php

namespace Src\Core;

use App\Models\User;

class Auth
{
    /**
     * Intenta autenticar un usuario con email/password.
     * [DeepSeek IA] Retorna ID de usuario (éxito) o false (fallo).
     */
    public static function attempt(string $email, string $password): int|false
    {
        $user = User::findByEmail($email); // Usa el nuevo método del modelo
        
        if ($user && password_verify($password, $user->password)) {
            self::login($user->id);
            return $user->id;
        }

        return false;
    }

    /**
     * Inicia sesión manualmente (ej: después de registro).
     */
    public static function login(int $userId): void
    {
        $_SESSION['user_id'] = $userId;
    }

    /**
     * Cierra la sesión.
     */
    public static function logout(): void
    {
        session_destroy();
    }

    /**
     * Obtiene el ID del usuario autenticado.
     */
    public static function id(): ?int
    {
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Verifica si hay un usuario logueado.
     */
    public static function check(): bool
    {
        return !empty(self::id());
    }

    /**
     * Obtiene el modelo User del usuario autenticado.
     */
    public static function user(): ?User
    {
        return self::check() ? User::find(self::id()) : null;
    }
}