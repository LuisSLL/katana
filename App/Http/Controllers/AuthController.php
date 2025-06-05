<?php
namespace App\Http\Controllers;

use App\Http\Models\User;
use Src\Core\BaseController;

class AuthController extends BaseController 
{
    public function showLogin()
    {
        return view('auth/login');
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            return view('auth/login', ['error' => 'Todos los campos son obligatorios.']);
        }

        $user = User::where('email', $email)->first();

        if ($user && $user->validatePassword($password)) {
            $_SESSION['user'] = [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ];
            return redirect('dashboard');
        }

        return view('auth/login', ['error' => 'Credenciales inválidas.']);
    }

    public function showRegister()
    {
        return view('auth/register');
    }

    public function register()
    {
        $name     = $_POST['name'] ?? '';
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($name) || empty($email) || empty($password)) {
            return view('auth/register', ['error' => 'Todos los campos son obligatorios.']);
        }

        $created = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => $password,
        ]);

        if ($created) {
            return redirect('/login');
        }

        return view('auth/register', ['error' => 'Error al registrar usuario.']);
    }

    public function logout()
    {
        session_destroy();
        return redirect('/login');
    }
}
