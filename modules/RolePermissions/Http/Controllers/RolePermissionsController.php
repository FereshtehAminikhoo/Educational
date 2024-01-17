<?php

namespace RolePermissions\Http\Controllers;

use App\Http\Controllers\Controller;
use Category\Responses\AjaxResponses;
use RolePermissions\Http\Requests\RoleRequest;
use RolePermissions\Http\Requests\RoleUpdateRequest;
use RolePermissions\Repositories\PermissionRepo;
use RolePermissions\Repositories\RoleRepo;


class RolePermissionsController extends Controller
{
    private $repository_role;
    private $repository_permission;

    public function __construct(RoleRepo $roleRepo, PermissionRepo $permissionRepo)
    {
        $this->repository_role = $roleRepo;
        $this->repository_permission = $permissionRepo;
    }

    public function index()
    {
        $roles = $this->repository_role->all();
        $permissions = $this->repository_permission->all();
        return view('RolePermissions::index', compact('roles', 'permissions'));
    }

    public function store(RoleRequest $request)
    {
        return $this->repository_role->create($request);
    }

    public function edit($roleId)
    {
        $role = $this->repository_role->findById($roleId);
        $permissions = $this->repository_permission->all();
        return view('RolePermissions::edit', compact('role', 'permissions'));
    }

    public function update(RoleUpdateRequest $request, $id)
    {
        $this->repository_role->update($id, $request);
        return redirect(route('role-permissions.index'));
    }

    public function destroy($roleId)
    {
        $this->repository_role->delete($roleId);
        return AjaxResponses::SuccessResponse();
    }

}
