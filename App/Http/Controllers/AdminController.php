<?php

namespace App\Http\Controllers;

use Src\Core\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin');

    }
    
}
