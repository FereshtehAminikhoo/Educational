<?php

namespace RolePermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    protected $guarded = [];


    const PERMISSION_SUPER_ADMIN = 'super admin';
    const PERMISSION_TEACH = 'teach';
    const PERMISSION_MANAGE_CATEGORIES = 'manage categories';
    const PERMISSION_MANAGE_ROLE_PERMISSIONS = 'manage role_permissions';
    const PERMISSION_MANAGE_USERS = 'manage users';
    const PERMISSION_MANAGE_COURSES = 'manage courses';
    const PERMISSION_MANAGE_OWN_COURSES = 'manage own courses';




    static $permissions = [
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_TEACH,
        self::PERMISSION_MANAGE_CATEGORIES,
        self::PERMISSION_MANAGE_ROLE_PERMISSIONS,
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANAGE_COURSES,
        self::PERMISSION_MANAGE_OWN_COURSES
    ];


}
