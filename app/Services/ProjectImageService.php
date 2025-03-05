<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ProjectImageService
{
    public function storeImages($project, array $images)
    {
        foreach ($images as $image) {
            $path = $image->store('images', 'public');
            $project->images()->create(['image_path' => $path]);
        }
    }

    public function deleteImages($project)
    {
        foreach ($project->images as $image) { 
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }
        $project->images()->delete();
    }
}
