<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Carbon\ProjectStoreRequest;
use App\Http\Requests\Carbon\ProjectUpdateRequest;
use App\Models\CarbonProject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class CarbonProjectController extends Controller
{   
    //View project
    public function index(): View {
        $carbonProjects = CarbonProject::with('credit')->paginate(15);
            return view('carbon-projects.index',compact('carbonProjects'));
    }

    //Create project
    public function create(): View {
        return view('carbon-projects.create');
    }

    //Store project
    public function store(ProjectStoreRequest $request): RedirectResponse {
        CarbonProject::create($request->validated());
            return redirect()->route('carbon-projects.index')->with('success', 'Project created successfully.');
    }

    //View project
    public function show(CarbonProject $carbonProjects): View {
        // dd($carbonProjects);
        return view('carbon-projects.show',compact('carbonProjects'));
    }

    //edit project
    public function edit(CarbonProject $carbonProjects): View {
        return view('carbon-projects.edit',compact('carbonProjects'));
    }

    //update project
    public function update(ProjectUpdateRequest $request, CarbonProject $carbonProjects) : RedirectResponse {
        $carbonProjects->update($request->validated());
            return redirect()->route('carbon-projects.index')->with('success','project up go');
    }

    //Destroy project
    public function destroy(CarbonProject $carbonProjects) : RedirectResponse{
        $carbonProjects->delete();
            return redirect()->route('carbon-projects.index')->with('success','project deleted');
    }
}
