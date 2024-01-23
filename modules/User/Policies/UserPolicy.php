<?php

namespace User\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use RolePermissions\Models\Permission;

class UserPolicy
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


    public function view($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)){
            return true;
        }
    }

    public function edit($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)){
            return true;
        }
    }

    public function addRole($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)){
            return true;
        }
    }

    public function removeRole($user)
    {
        if($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)){
            return true;
        }
    }
}
