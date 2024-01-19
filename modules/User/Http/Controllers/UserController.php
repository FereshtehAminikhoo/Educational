<?php

namespace User\Http\Controllers;

use App\Http\Controllers\Controller;
use RolePermissions\Repositories\RoleRepo;
use User\Http\Requests\AddRoleRequest;
use User\Models\User;
use User\Repositories\UserRepo;

class UserController extends Controller
{
    /**
     * @var UserRepo
     */
    private $repository;
    private $repository_role;

    public function __construct(UserRepo $userRepo, RoleRepo $roleRepo)
    {
        $this->repository = $userRepo;
        $this->repository_role = $roleRepo;
    }


    public function index()
    {
        $this->authorize('view', User::class);
        $users = $this->repository->paginate();
        $roles = $this->repository_role->all();
        return view('User::Admin.index', compact('users', 'roles'));
    }

    public function addRole(AddRoleRequest $request, User $user)
    {
        $this->authorize('addRole', User::class);
        $user->assignRole($request->role);
        newFeedback('موفقیت آمیز',  " نقش کاربری {$request->role} به کاربر {$user->name} داده شد ", 'success' );
        return back();
    }
}
