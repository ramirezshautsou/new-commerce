<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomePageController extends Controller
{
    public function index(): View
    {
        return view('home');
    }
}
