<?php

namespace App\Policies;

use App\Models\National;
use App\Models\User;

class NationalPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole(['president','manager']);
    }

    public function view(User $user)
    {
        return $user->hasRole(['president','manager']);
    }

    public function create(User $user)
    {
        return $user->hasRole(['president']);
    }

    public function update(User $user)
    {
        return $user->hasRole(['president']);
    }

    public function delete(User $user)
    {
        return $user->hasRole(['president']);
    }
}
