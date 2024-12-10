<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Carbon\ProjectStoreRequest;
use App\Http\Requests\Carbon\ProjectUpdateRequest;
use App\Models\CarbonProject;
use App\Models\Image;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CarbonProjectController extends Controller
{   
    //View project
    public function index(): View {
        $carbonProjects = CarbonProject::with(['credits','images'])->paginate(15);
            return view('carbon-projects.index',compact('carbonProjects'));
    }

    //Create project
    public function create(): View {
        return view('carbon-projects.create');
    }

    //Store project
    public function store(ProjectStoreRequest $request): RedirectResponse {
        
        // Lưu thông tin dự án vào cơ sở dữ liệu
        $carbonProjects = CarbonProject::create($request->validated());

        // Kiểm tra nếu có ảnh được tải lên
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Lưu trữ ảnh với các quy định cụ thể về định dạng và dung lượng
                $path = $image->store('projects', 'public'); //// Lưu ảnh vào thư mục 'projects' với định dạng 'public'
                // Mỗi ảnh sẽ được lưu vào bảng 'images' kèm theo ID của dự án
                Image::create([
                    'project_id' => $carbonProjects->id,
                    'image_path' => $path,
                ]);
            }
        }
        // dd($request->all()); // kiểm tra dữ liệu gửi từ form
        // dd($request->file('images')); // kiểm tra file được upload
        // dd($carbonProjects->images); // kiểm tra ảnh liên kết với dự án
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

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                Image::create([
                    'project_id' => $carbonProjects->id,
                    'image_path' => $path,
                ]);
            }
        }
            return redirect()->route('carbon-projects.index')->with('success','project up go');
    }

    //Destroy project
    public function destroy(CarbonProject $carbonProjects) : RedirectResponse{

        $carbonProjects->delete();
            return redirect()->route('carbon-projects.index')->with('success','project deleted');
    }
}
