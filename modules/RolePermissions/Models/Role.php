<?php

namespace RolePermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    protected $guarded = [];

    const ROLE_TEACHER = 'teacher';
    static $roles = [
        self::ROLE_TEACHER => [
            Permission::PERMISSION_TEACH
        ]
    ];
}
