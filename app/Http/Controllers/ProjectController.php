<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\ProjectType;
use App\Models\Standard;
use App\Services\ProjectService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    // Danh sách dự án
    public function index(): View
    {
        $projects = $this->projectService->getAllProjects();
        return view('admin.projects.index', compact('projects'));
    }

    // Xem chi tiết dự án
    public function show($id): View
    {
        $project = $this->projectService->getProjectById($id);
        return view('admin.projects.show', compact('project'));
    }

    // Form tạo dự án
    public function create(): View
    {
        $projectTypes = ProjectType::all();
        $standards = Standard::all();
        return view('admin.projects.create', compact(['projectTypes', 'standards']));
    }

    // Lưu dự án
    public function store(ProjectRequest $request): RedirectResponse
    {
        $this->projectService->createProject($request->validated());
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    // Form chỉnh sửa dự án
    public function edit($id): View
    {
        $project = $this->projectService->getProjectById($id);
        $projectTypes = ProjectType::all();
        return view('admin.projects.edit', compact(['project', 'projectTypes']));
    }

    // Cập nhật dự án
    public function update(ProjectRequest $request, $id): RedirectResponse
    {
        $this->projectService->updateProject($id, $request->validated());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    // Xóa dự án
    public function destroy($id): RedirectResponse
    {
        $this->projectService->deleteProject($id);
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}