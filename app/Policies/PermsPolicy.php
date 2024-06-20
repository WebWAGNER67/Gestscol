<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermsPolicy
{

    use HandlesAuthorization;

    public function viewImportForm(User $user)
    {
        return $user->role === 'admin';
    }

    public function viewHome(User $user)
    {
        return $user->code_diplome !== null;
    }

    public function viewEDTHome(User $user)
    {
        return $user->role === 'eleve' || $user->role === 'prof';
    }

    public function viewAbences(User $user)
    {
        return $user->role === "eleve";
    }

    public function viewPromo(User $user)
    {
        return $user->role === 'eleve';
    }

    public function viewGroup(User $user)
    {
        return $user->role === 'eleve';
    }

    public function viewTrombi(User $user)
    {
        return $user->role === 'prof' || $user->role === 'admin';
    }

    public function viewAllAbsences(User $user)
    {
        return $user->role === 'prof' || $user->role === 'admin';
    }

    public function viewGroupNav(User $user)
    {
        return $user->role === 'eleve';
    }

    public function viewPromoNav(User $user)
    {
        return $user->role === 'eleve';
    }

    public function viewAbsencesNav(User $user)
    {
        return $user->role === 'eleve';
    }

    public function viewTrombiNav(User $user)
    {
        return $user->role === 'prof' || $user->role === 'admin';
    }

    public function viewQRCode(User $user)
    {
        return $user->role === 'prof';
    }

    public function viewJustifyAbsence(User $user)
    {
        return $user->role === 'eleve';
    }

    public function createAll(User $user)
    {
        return $user->role === 'admin';
    }

    public function AcceptJustificatif(User $user)
    {
        return $user->role === 'admin';
    }
}
