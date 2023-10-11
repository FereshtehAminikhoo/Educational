<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use User\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_login_by_email()
    {
        $user = User::create([
            'name'=>$this->faker->name,
            'email'=>$this->faker->safeEmail,
            'password'=>bcrypt('Aa123456@')
        ]);

        $this->post(route('login'), [
            'email'=>$user->email,
            'password'=>'Aa123456@'
        ]);
        $this->assertAuthenticated();
    }

    public function test_user_can_login_by_mobile()
    {
        $user = User::create([
            'name'=>$this->faker->name,
            'email'=>$this->faker->safeEmail,
            'mobile'=>'9395005050',
            'password'=>bcrypt('Aa123456@')
        ]);

        $this->post(route('login'), [
            'email'=>$user->mobile,
            'password'=>'Aa123456@'
        ]);
        $this->assertAuthenticated();
    }
}
