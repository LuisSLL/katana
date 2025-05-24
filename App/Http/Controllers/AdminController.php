<?php

namespace App\Http\Controllers;

use Src\Core\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            redirect('/login');
            return;
        }

        $this->view('admin', [
            'title' => 'Panel de Administración',
            'user' => $_SESSION['user']
        ]);
    }
    
}
