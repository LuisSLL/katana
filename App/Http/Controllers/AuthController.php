<?php
//App/Http/Controllers/AuthController.php
namespace App\Http\Controllers;
use Src\Core\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    public function showLogin()
    {
        //return view('auth/login');
        $this->view('auth/login', ['title' => 'Login'], 'auth');

    }

    public function showRegister()
    {
        //return view('auth/register');
        $this->view('auth/register', ['title' => 'Registro'], 'auth');
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

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
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (User::findByEmail($email)) {
            $_SESSION['error'] = 'El email ya está registrado.';
            redirect('/register');
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
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
