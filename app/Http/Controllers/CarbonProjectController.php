<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Carbon\ProjectRequest;
use App\Models\CarbonProject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class CarbonProjectController extends Controller
{   
    //View project
    public function index(): View {
        $carbonProjects = CarbonProject::with('credits')->paginate(15);
            return view('carbon-projects.index',compact('carbonProjects'));
    }

    //Create project
    public function create(): View {
        return view('carbon-projects.create');
    }

    //Store project
    public function store(ProjectRequest $request): RedirectResponse {
        CarbonProject::create($request->validated());
            return redirect()->route('carbon-projects.index')->with('success', 'Project created successfully.');
    }
}
