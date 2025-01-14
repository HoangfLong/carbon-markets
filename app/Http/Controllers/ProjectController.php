<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Carbon\ProjectStoreRequest;
use App\Http\Requests\Carbon\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Standard;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

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
            return view('carbon-projects.index',compact('carbonProjects'));
    }

   //View project
    public function show($id): View 
    {
        $carbonProjects = $this->projectRepository->getById($id);
            return view('carbon-projects.show',compact('carbonProjects'));
    }

    //Create project
    public function create(): View 
    {
        $projectTypes = ProjectType::all();
        $standards = Standard::all();
            return view('carbon-projects.create',compact(['projectTypes','standards']));
    }

    //Store project
    public function store(ProjectStoreRequest $request): RedirectResponse {
        
        // Lưu thông tin dự án vào cơ sở dữ liệu
        $this->projectRepository->create($request->validated());

        // Kiểm tra nếu có ảnh được tải lên
        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $image) {
        //         // Lưu trữ ảnh với các quy định cụ thể về định dạng và dung lượng
        //         $path = $image->store('projects', 'public'); //// Lưu ảnh vào thư mục 'projects' với định dạng 'public'
        //         // Mỗi ảnh sẽ được lưu vào bảng 'images' kèm theo ID của dự án
        //         Image::create([
        //             'project_id' => $carbonProjects->id,
        //             'image_path' => $path,
        //         ]);
        //     }
        // }
        // dd($request->all()); // kiểm tra dữ liệu gửi từ form
        // dd($request->file('images')); // kiểm tra file được upload
        // dd($carbonProjects->images); // kiểm tra ảnh liên kết với dự án
            return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    //edit project
    public function edit($id): View 
    {
        $carbonProjects = $this->projectRepository->getById($id);
        $projectTypes = ProjectType::all();
        $standards = Standard::all();
            return view('carbon-projects.edit',compact(['carbonProjects', 'projectTypes', 'standards']));
    }

    //update project
    public function update(ProjectUpdateRequest $request, $id) : RedirectResponse {

        //Cập nhật các thông tin dự án
        $this->projectRepository->update($id, $request->validated());

        // if ($request->hasFile('images')) {
        //     // Xóa các ảnh cũ liên quan đến dự án
        //     $carbonProjects->images()->delete(); // Xóa ảnh cũ nếu có
        //     // Lưu các ảnh mới
        //     foreach ($request->file('images') as $image) {
        //         $path = $image->store('projects', 'public');
        //         // Lưu đường dẫn ảnh vào bảng 'images'
        //         Image::create([
        //             'project_id' => $carbonProjects->id,
        //             'image_path' => $path,
        //         ]);
        //     }
        // }
            return redirect()->route('projects.index')->with('success','project up go');
    }

    //Destroy project
    public function destroy($id) : RedirectResponse{

        // foreach ($carbonProjects->images as $image) {
        //     // Kiểm tra nếu file tồn tại trong storage và xóa
        //     if (Storage::disk('public')->exists($image->image_path)) {
        //         Storage::disk('public')->delete($image->image_path);
        //     }
        // }
        // Xóa các ảnh trong cơ sở dữ liệu
        $this->projectRepository->delete($id);
            return redirect()->route('projects.index')->with('success','project deleted');
    }
}
