<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determina si el usuario puede crear otros usuarios.
     */
    public function create(User $authUser)
    {
        return $authUser->isAdmin();
    }

    /**
     * Determina si el usuario puede borrar a otro usuario.
     */
    public function delete(User $authUser, User $user)
    {
        return $authUser->canDeleteUser($user);
    }

    /**
     * Determina si el usuario puede borrar backups.
     */
    public function deleteBackups(User $authUser)
    {
        return $authUser->canDeleteBackups();
    }
}
