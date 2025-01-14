<?php

namespace App\Repositories;

use App\Interfaces\IProjectRepository;
use App\Models\Image;
use App\Models\Project;

//use Your Model

/**
 * Class ProjectRepository.
 */
class ProjectRepository implements IProjectRepository
{
    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function getAll()
    {
        return Project::all();
    }

    public function getById($id)
    {
        return Project::findOrFail($id);
    }

    public function create(array $data)
    {
        $project = Project::create($data);
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
        $project->update($data);
            return $project;
    }

    public function delete($id)
    {
        $project = $this->project->findOrFail($id);
            return $project->delete();
    }
}

