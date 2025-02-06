<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectStoreRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Models\ProjectType;
use App\Models\Standard;
use App\Repositories\Eloquent\ProjectRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{   
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    //Index project
    public function index(): View 
    {
        $carbonProjects = $this->projectRepository->getAll();
            return view('admin.projects.index',compact('carbonProjects'));
    }

   //View project
    public function show($id): View 
    {
        $carbonProjects = $this->projectRepository->getById($id);
            return view('admin.projects.show',compact('carbonProjects'));
    }

    //Create project
    public function create(): View 
    {
        $projectTypes = ProjectType::all();
        $standards = Standard::all();
            return view('admin.projects.create',compact(['projectTypes','standards']));
    }

    //Store project
    public function store(ProjectStoreRequest $request): RedirectResponse
    {
        // Lưu thông tin dự án vào cơ sở dữ liệu
        $this->projectRepository->create($request->validated());
            return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    //edit project
    public function edit($id): View 
    {
        $carbonProjects = $this->projectRepository->getById($id);
        $projectTypes = ProjectType::all();
            return view('admin.projects.edit',compact(['carbonProjects', 'projectTypes']));
    }

    //update project
    public function update(ProjectUpdateRequest $request, $id) : RedirectResponse
    {
       
        //Cập nhật các thông tin dự án
        $this->projectRepository->update($id, $request->validated());
            return redirect()->route('projects.index')->with('success','project up go');
    }

    //Destroy project
    public function destroy($id): RedirectResponse
    {
        $this->projectRepository->delete($id);
            return redirect()->route('projects.index')->with('success','project deleted');
    }
}
