<?php

namespace User\Tests\Unit;

use PHPUnit\Framework\TestCase;
use User\Rules\ValidPassword;

class PasswordValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_password_should_not_be_less_than_6_character()
    {
        $result = (new ValidPassword())->passes('', 'Aa12!');
        $this->assertEquals(0, $result);
    }

    public function test_password_should_include_sign_character()
    {
        $result = (new ValidPassword())->passes('', 'Aa12dfs');
        $this->assertEquals(0, $result);
    }

    public function test_password_should_include_digit_character()
    {
        $result = (new ValidPassword())->passes('', 'Aambvfs@');
        $this->assertEquals(0, $result);
    }

    public function test_password_should_include_Capital_character()
    {
        $result = (new ValidPassword())->passes('', 'jbvjdbv@');
        $this->assertEquals(0, $result);
    }

    public function test_password_should_include_small_character()
    {
        $result = (new ValidPassword())->passes('', 'ABJDVKJCHKSJDVF@');
        $this->assertEquals(0, $result);
    }
}
