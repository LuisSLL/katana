<?php
namespace App\Http\Controllers;

use Src\Core\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $user = $_SESSION['user'] ?? null;

        if (!$user) {
            return redirect('login');
        }

        return view('admin/dashboard', ['user' => $user]);
    }
}
