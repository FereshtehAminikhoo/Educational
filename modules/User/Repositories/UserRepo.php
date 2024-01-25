<?php

namespace User\Repositories;

use RolePermissions\Models\Permission;
use User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function getTeachers()
    {
        return User::permission(Permission::PERMISSION_TEACH)->get();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function paginate()
    {
        return User::paginate();
    }

    public function update($userId, $values)
    {
        $update = [
            'name' => $values->name,
            'email' => $values->email,
            'username' => $values->username,
            'mobile' => $values->mobile,
            'headline' => $values->headline,
            'telegram' => $values->telegram,
            'status' => $values->status,
            'image_id' => $values->image_id,
            'bio' => $values->bio,
        ];

        if (! is_null($values->password)){
            $update['password'] = bcrypt($values->password);
        }
        return User::where('id', $userId)->update($update);
    }
}
