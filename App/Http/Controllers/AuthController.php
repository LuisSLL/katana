<?php
//  App/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Src\Core\BaseController;
use App\Http\Models\User;

class AuthController extends BaseController
{
    public function showLogin()
    {
        $this->view('auth/login', ['title' => 'Login'], 'auth');
    }

    public function showRegister()
    {
        $this->view('auth/register', ['title' => 'Registro'], 'auth');
    }

    public function login()
    {
        $email = ($_POST['email'] ?? '');
        $password = ($_POST['password'] ?? '');

        if (!$email || !$password) {
            $_SESSION['error'] = 'Email y contraseña son obligatorios.';
            redirect('/login');
        }

        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            redirect('/admin');
            
        } else {
            $_SESSION['error'] = 'Credenciales inválidas.';
            redirect('/login');
        }
    }

    public function register()
    {
        $name = ($_POST['name'] ?? '');
        $email = ($_POST['email'] ?? '');
        $password = ($_POST['password'] ?? '');

        if (!$name || !$email || !$password) {
            $_SESSION['error'] = 'Todos los campos son obligatorios.';
            redirect('/register');
        }

        if (User::findByEmail($email)) {
            $_SESSION['error'] = 'El email ya está registrado.';
            redirect('/register');
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        $_SESSION['success'] = 'Registro exitoso. Ya puedes iniciar sesión.';
        redirect('/login');
    }

    public function logout()
    {
        session_destroy();
        redirect('/');
    }
}
