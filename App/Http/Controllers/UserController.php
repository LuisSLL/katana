<?php
// App/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Src\Core\BaseController;
use App\Http\Models\User;

class UserController extends BaseController
{
    /**
     * Muestra el perfil del usuario
     */
    public function showProfile(int $userId)
    {
        $user = User::find($userId);
        return view('users/profile', ['user' => $user]);
    }
}