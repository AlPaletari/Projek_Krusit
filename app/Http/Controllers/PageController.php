<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function welcome(): View
    {
        return view('welcome');
    }

    public function dashboard(): View
    {
        return view('dashboard');
    }

    public function kontak(): View
    {
        return view('kontak');
    }

    public function menu(): View
    {
        return view('menu');
    }
}
