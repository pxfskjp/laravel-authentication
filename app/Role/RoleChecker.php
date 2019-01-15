<?php

namespace App\Role;

use App\User as User;
use App\Role\UserRole as UserRole;

class RoleChecker
{
    /**
     * @param User $user
     * @param string $role
     * @return bool
     */
    public function check(User $user, string $role)
    {
        return $user->hasRole(UserRole::ROLE_ADMIN) || $user->hasRole($role);
    }
}
