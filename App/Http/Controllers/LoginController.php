<?php
namespace App\Http\Controllers;

class LoginController
{
    public function showLogin()
    {
        return view('auth/login');
    }

    public function login()
    {
        $user = $_POST['user'] ?? '';
        $pass = $_POST['pass'] ?? '';
        $error = null;

        if ($user === 'katanaframework' && $pass === 'admin123') {
            $_SESSION['user'] = [
                'username' => $user
            ];
            header('Location: /dashboard');
            exit;
        } else {
            $error = 'Usuario o contraseña incorrectos';
        }
        return view('auth/login', ['error' => $error]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /login');
        exit;
    }
}