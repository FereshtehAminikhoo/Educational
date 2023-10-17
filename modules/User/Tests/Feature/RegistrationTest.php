<?php

namespace User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use User\Models\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_user_can_see_register_form()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        $this->withoutExceptionHandling();

        $response = $this->registerNewUser();

        $response->assertRedirect(route('home'));
        $this->assertCount(1, User::all());
    }

    public function test_user_have_to_verify_account()
    {
        $this->registerNewUser();

        $response = $this->get(route('home'));
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_verified_user_can_see_home_page()
    {
        $this->registerNewUser();

        $this->assertAuthenticated();
        auth()->user()->markEmailAsVerified();
        $response = $this->get(route('home'));
        $response->assertOk();
    }

    /**
     * @return
     */
    public function registerNewUser()
    {
        return $this->post(route('register'), [
            'name' => 'test2',
            'email' => 'test2@gmail.com',
            'mobile' => '9395005050',
            'password' => 'Gg123456@',
            'password_confirmation' => 'Gg123456@'
        ]);
    }
}
