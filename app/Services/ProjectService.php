<?php

namespace App\Services;

use App\Repositories\Eloquent\ProjectRepository;

class ProjectService
{
    protected $projectRepository;
    protected $imageService;

    public function __construct(ProjectRepository $projectRepository, ProjectImageService $imageService)
    {
        $this->projectRepository = $projectRepository;
        $this->imageService = $imageService;
    }

    public function getAllProjects()
    {
        return $this->projectRepository->getAll();
    }

    public function getProjectById($id)
    {
        return $this->projectRepository->getById($id);
    }

    public function createProject(array $data)
    {
        $project = $this->projectRepository->create($data);

        if (!empty($data['images'])) {
            $this->imageService->storeImages($project, $data['images']);
        }

        return $project;
    }

    public function updateProject($id, array $data)
    {
        $project = $this->projectRepository->update($id, $data);

        if (!empty($data['images'])) {
            $this->imageService->deleteImages($project);
            $this->imageService->storeImages($project, $data['images']);
        }

        return $project;
    }

    public function deleteProject($id)
    {
        $project = $this->projectRepository->getById($id);
        $this->imageService->deleteImages($project);
        return $this->projectRepository->delete($id);
    }

    public function searchProjects($search)
    {
        return $this->projectRepository->search($search);
    }
}
