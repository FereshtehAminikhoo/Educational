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


}
