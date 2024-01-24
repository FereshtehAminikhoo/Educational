<?php

namespace User\Database\Seeds;

use Illuminate\Database\Seeder;
use User\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(User::$defaultUsers as $user){
            User::firstOrCreate(
                ['email'=> $user['email']]
                ,[
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
                'name' => $user['name'],
            ])->assignRole($user['role']);
        }
    }
}
