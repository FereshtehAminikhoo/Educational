<?php

namespace User\Repositories;

use User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }
}
