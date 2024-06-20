<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewEDTHome(User $user): bool
    {
        return $user->role == 'eleve' or $user->role == 'prof';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function viewAllEDT(User $user, User $model): bool
    {
        return $user->role == "admin" or $user->role == "prof";
    }

    public function viewAbences(User $user): bool
    {
        return $user->role == "eleve";
    }

    public function viewHome(User $user): bool
    {
        return $user->code_diplome != null;
    }
}
