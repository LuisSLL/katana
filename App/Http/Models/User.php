<?php
namespace App\Http\Models;

use Src\Core\Model;

class User extends Model
{
    protected string $table = 'users';

    public static function create(array $data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return parent::create($data);
    }

    public function validatePassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function roles(): array
    {
        return [];
    }
}
