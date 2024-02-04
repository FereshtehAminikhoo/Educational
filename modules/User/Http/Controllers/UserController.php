<?php

namespace User\Http\Controllers;

use App\Http\Controllers\Controller;
use Media\Services\MediaFileService;
use Common\Responses\AjaxResponses;
use RolePermissions\Repositories\RoleRepo;
use User\Http\Requests\AddRoleRequest;
use User\Http\Requests\UpdateProfileInformationRequest;
use User\Http\Requests\UpdateUserPhotoRequest;
use User\Http\Requests\UpdateUserRequest;
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

    public function edit($userId)
    {
        $this->authorize('edit', User::class);
        $user = $this->repository->findById($userId);
        return view('User::Admin.edit', compact('user'));
    }

    public function update($userId, UpdateUserRequest $request)
    {
        $this->authorize('edit', User::class);
        $user = $this->repository->findById($userId);
        if($request->hasFile('image')){
            $request->request->add(['image_id' => MediaFileService::publicUpload($request->file('image'))->id]);
            if ($user->banner)
                $user->banner->delete();
        }else{
            $request->request->add(['image_id' => $user->image_id]);
        }

        $this->repository->update($userId, $request);
        newFeedback();
        return redirect(route('users.index'));
    }

    public function updatePhoto(UpdateUserPhotoRequest $request)
    {
        $this->authorize('editProfile', User::class);
        $media = MediaFileService::publicUpload($request->file('userPhoto'));
        if(auth()->user()->image) auth()->user()->image->delete();
        auth()->user()->image_id = $media->id;
        auth()->user()->save();
        newFeedback();
        return back();
    }

    public function profile()
    {
        $this->authorize('editProfile', User::class);
        return view('User::Admin.profile');
    }

    public function updateProfile(UpdateProfileInformationRequest $request)
    {
        $this->authorize('editProfile', User::class);
        $this->repository->updateProfile($request);
        newFeedback();
        return back();
    }

    public function destroy($userId)
    {
        $this->authorize('delete', User::class);
        $user = $this->repository->findById($userId);
        $user->delete();
        return AjaxResponses::SuccessResponse();
    }

    public function manualVerify($userId)
    {
        $this->authorize('manualVerify', User::class);
        $user = $this->repository->findById($userId);
        $user->markEmailAsVerified();
        return AjaxResponses::SuccessResponse();
    }

    public function addRole(AddRoleRequest $request, User $user)
    {
        $this->authorize('addRole', User::class);
        $user->assignRole($request->role);
        newFeedback('موفقیت آمیز',  " نقش کاربری {$request->role} به کاربر {$user->name} داده شد ", 'success' );
        return back();
    }

    public function removeRole($userId, $role)
    {
        $this->authorize('removeRole', User::class);
        $user = $this->repository->findById($userId);
        $user->removeRole($role);
        return AjaxResponses::SuccessResponse();
    }
}
