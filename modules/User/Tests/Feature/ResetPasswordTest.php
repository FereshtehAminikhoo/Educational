<?php


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_user_can_see_reset_password_request_form()
    {
        $response = $this->get(route('password.request'));
        $response -> assertOk();
    }

    public function test_user_see_enter_verify_code_form_by_correct_email()
    {
        $response = $this->call('get', route('password.sendVerifyCodeEmail'), ['email' => 'test2@gmail.com']);
        $response -> assertOk();
    }

    public function test_user_cannot_see_enter_verify_code_form_by_wrong_email()
    {
        $response = $this->call('get', route('password.sendVerifyCodeEmail'), ['email' => 'test2.com']);
        $response -> assertStatus(302);
    }

    public function test_user_banned_after_6_attempt_to_reset_password()
    {
        for ($i=0 ; $i<5; $i++){
            $response = $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'test2@gmail.com']);
            $response -> assertStatus(302);
        }

        $response = $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'test2@gmail.com']);
        $response -> assertStatus(429);

    }


}
