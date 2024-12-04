<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CarbonProject;
use Illuminate\Http\Request;

class CarbonProjectController extends Controller
{   
    //View project
    public function index() {
        $carbonProjects = CarbonProject::with('credits')->paginate(15);
            return view('carbon-projects.index',compact('carbonProjects'));
    }
}
