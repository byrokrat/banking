<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class CheckDigitType1AValidatorTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testValidCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingNumber()->willReturn('0333');
        $number->getSerialNumber()->willReturn('111111');
        $number->getCheckDigit()->willReturn('2');

        $this->assertInstanceOf(
            Success::CLASS,
            (new CheckDigitType1AValidator())->validate($number->reveal())
        );
    }

    public function testInvalidCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingNumber()->willReturn('0333');
        $number->getSerialNumber()->willReturn('666666');
        $number->getCheckDigit()->willReturn('7');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new CheckDigitType1AValidator())->validate($number->reveal())
        );
    }
}
