<?php
namespace App\Models;

use Src\Core\Model;

class User extends Model
{
    protected string $table = 'users';

    /**
     * Crea un usuario con password hasheado.
     */
    public static function create(array $data): ?self
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return parent::create($data);
    }

    /**
     * Verifica la contraseña.
     */
    public function validatePassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}