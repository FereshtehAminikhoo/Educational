<?php

namespace User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use User\Models\User;
use User\Services\VerifyCodeService;

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

    public function test_user_can_verify_account()
    {
        $user = User::create([
            'name'=>'test1',
            'email'=>'test1@gmail.com',
            'password'=>bcrypt('Aa123456@')
        ]);

        $code = VerifyCodeService::generate();
        VerifyCodeService::store($user->id, $code);

        auth()->loginUsingId($user->id);
        $this->assertAuthenticated();

        $this->post(route('verification.verify'), [
            'verify_code' => $code
        ]);

        $this->assertEquals(true, $user->fresh()->hasVerifiedEmail());

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
