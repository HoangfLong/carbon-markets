<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ProjectPolicy
{
    /**
     * Xác định người dùng có quyền tạo project hay không.
     */
    public function view(User $user, Project $project)
    {
        return $user->id === $project->user_id || $user->role === 'admin';
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function update(User $user, Project $project)
    {
        return $user->id === $project->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Project $project)
    {
        return $user->id === $project->user_id || $user->role === 'admin';
    }
}
