<?php

namespace App\Http\Controllers;

class PostController
{
    public function show($id)
    {
        return view('post', ['id' => $id]);
    }
}
