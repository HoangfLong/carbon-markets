<?php

namespace App\Repositories\Eloquent;

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
        return $this->project->create($data);
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

    public function search($search)
    {
        $keywords = preg_split('/\s+/', $search);

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