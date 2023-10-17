<?php

namespace User\Tests\Unit;

use PHPUnit\Framework\TestCase;
use User\Rules\ValidMobile;

class MobileValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_mobile_can_not_be_less_than_10_character()
    {
        $result = (new ValidMobile())->passes('', '939200202');
        $this->assertEquals(0, $result);
    }

    public function test_mobile_can_not_be_more_than_10_character()
    {
        $result = (new ValidMobile())->passes('', '93920020212');
        $this->assertEquals(0, $result);
    }

    public function test_mobile_should_start_by_9()
    {
        $result = (new ValidMobile())->passes('', '3392002021');
        $this->assertEquals(0, $result);
    }

}
