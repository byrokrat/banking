<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class CheckDigitType2ValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testValidCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('666666');
        $number->getCheckDigit()->willReturn('3');

        $this->assertInstanceOf(
            Success::CLASS,
            (new CheckDigitType2Validator)->validate($number->reveal())
        );
    }

    public function testInvalidCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('666666');
        $number->getCheckDigit()->willReturn('7');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new CheckDigitType2Validator)->validate($number->reveal())
        );
    }
}
