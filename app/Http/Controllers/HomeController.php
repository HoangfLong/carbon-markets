<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        return view('carbon-credits.home');
    }

    public function market() {
        return view('carbon-credits.market');
    }
}
