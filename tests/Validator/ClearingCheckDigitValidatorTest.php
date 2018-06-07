<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class ClearingCheckDigitValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testValidClearingCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingNumber()->willReturn('4444');
        $number->getClearingCheckDigit()->willReturn('6');

        $this->assertInstanceOf(
            Success::CLASS,
            (new ClearingCheckDigitValidator)->validate($number->reveal())
        );
    }

    public function testInvalidClearingCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingNumber()->willReturn('4444');
        $number->getClearingCheckDigit()->willReturn('5');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new ClearingCheckDigitValidator)->validate($number->reveal())
        );
    }

    public function testInvalidClearingCheckDigitCero()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingNumber()->willReturn('4444');
        $number->getClearingCheckDigit()->willReturn('0');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new ClearingCheckDigitValidator)->validate($number->reveal())
        );
    }

    public function testNoClearingCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingNumber()->willReturn('4444');
        $number->getClearingCheckDigit()->willReturn('');

        $this->assertInstanceOf(
            Success::CLASS,
            (new ClearingCheckDigitValidator)->validate($number->reveal())
        );
    }
}
