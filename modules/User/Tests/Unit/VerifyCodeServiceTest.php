<?php

namespace User\Tests\Unit;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Tests\TestCase;
use User\Services\VerifyCodeService;


class VerifyCodeServiceTest extends TestCase
{
    public function test_generated_code_is_6_digit()
    {
        $code = VerifyCodeService::generate();
        $this->assertIsNumeric($code, 'Generated code is not numeric');
        $this->assertLessThanOrEqual(999999, $code, 'Generated code is less than 999999');
        $this->assertGreaterThanOrEqual(100000, $code, 'Generated code is greater than 999999');
    }


    public function test_verify_code_can_store()
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(1, $code, 120);

        $this->assertEquals($code, cache()->get('verify_code_1'));
    }
}
