<?php
namespace App\Http\Controllers;

class DashboardController
{
    public function index()
    {
        $user = $_SESSION['user']['username'] ?? 'Invitado';
        return view('dashboard', ['user' => $user]);
    }
}