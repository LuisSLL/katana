<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserController
{
    /**
     * Muestra el perfil de un usuario por ID.
     */
    public function showProfile($id)
    {
        // Ejemplo de uso del modelo User
        $user = User::find($id);
        if (!$user) {
            return view('errors/404');
        }
        return view('user/profile', ['user' => $user]);
    }
}