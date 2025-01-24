<?php

namespace App\Policies;

use App\Models\Credit;
use App\Models\User;

class CreditPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user, Credit $credit)
    {
        return $user->id === $credit->user_id || $user->role === 'admin';
    }

    public function create(User $user) 
    {
        return in_array($user->role, ['admin','manager']);
    }

    public function update(User $user, Credit $credit)
    {
        return $user->id === $credit->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Credit $credit)
    {
        return $user->id === $credit->user_id || $user->role === 'admin';
    }
}
