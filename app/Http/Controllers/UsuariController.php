<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuariController extends Controller
{
    public function index()
    {
        return \view('rols');
    }
}