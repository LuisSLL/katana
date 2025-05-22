<?php

namespace App\Http\Controllers;

use Src\Core\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        return view('home');
    }
}
