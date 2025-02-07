<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Repositories\Contracts\IBaseRepository;

//use Your Model

/**
 * Class ProjectRepository.
 */
class ProjectRepository implements IBaseRepository
{
    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function getAll()
    {
        return $this->project->all();
    }

    public function getById($id)
    {
        return $this->project->findOrFail($id);
    }

    public function create(array $data)
    {
        $project = $this->project->create($data);
        // Lưu hình ảnh nếu có
        if (!empty($data['images'])) {
            foreach ($data['images'] as $image) {
                $path = $image->store('images', 'public');

                $project->images()->create([
                    'image_path' => $path,
                ]);
            }
        }
        return $project;
    }

    public function update($id, array $data)
    {
        $project = $this->project->findOrFail($id);
        //Update the project fields
        $project->update($data);

        if (!empty($data['images'])) {
            $project->images()->delete();
            foreach ($data['images'] as $image) {

                $path = $image->store('images', 'public');

                $project->images()->create([
                    'image_path' => $path,
                ]);
            }
        }
        return $project;
    }

    public function delete($id)
    {
        $project = $this->project->findOrFail($id);
        foreach($project->images as $image) { 
            if(Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }
        return $project->delete();
    }


    public function search($search)
    {
        $keywords = preg_split('/\s+/', $search); // Tách theo khoảng trắng
    
        return $this->project->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->whereRaw('LOWER(name) LIKE LOWER(?)', ["%{$keyword}%"])
                    ->orWhereRaw('LOWER(description) LIKE LOWER(?)', ["%{$keyword}%"]);
            }
        })
        ->where('status', 'Certified')
        ->with(['credits', 'images'])
        ->get();
    }
}

