<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class CheckDigitType1BValidatorTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testValidCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingNumber()->willReturn('4444');
        $number->getSerialNumber()->willReturn('666666');
        $number->getCheckDigit()->willReturn('1');

        $this->assertInstanceOf(
            Success::CLASS,
            (new CheckDigitType1BValidator)->validate($number->reveal())
        );
    }

    public function testInvalidCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingNumber()->willReturn('4444');
        $number->getSerialNumber()->willReturn('666666');
        $number->getCheckDigit()->willReturn('7');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new CheckDigitType1BValidator)->validate($number->reveal())
        );
    }
}
