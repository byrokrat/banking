<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class CheckDigitHandelsbankenValidatorTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testValidCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('666666');
        $number->getCheckDigit()->willReturn('3');

        $this->assertInstanceOf(
            Success::CLASS,
            (new CheckDigitHandelsbankenValidator())->validate($number->reveal())
        );
    }

    public function testInvalidCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('666666');
        $number->getCheckDigit()->willReturn('7');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new CheckDigitHandelsbankenValidator())->validate($number->reveal())
        );
    }
}
