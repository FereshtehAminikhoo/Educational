<?php

namespace Category\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use RolePermissions\Models\Permission;
use User\Models\User;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
    }
}
