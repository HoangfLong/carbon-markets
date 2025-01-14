<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function home(): View {
        return view('home');
    }
     //Marketplace view
     public function market(): View {
        $carbonProjects = Project::latest()->get();
            return view('carbon-projects.marketplace',compact('carbonProjects'));
    }
}
