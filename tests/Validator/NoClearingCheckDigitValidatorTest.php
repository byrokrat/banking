<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class NoClearingCheckDigitValidatorTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testNoClearingCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingCheckDigit()->willReturn('');

        $this->assertInstanceOf(
            Success::CLASS,
            (new NoClearingCheckDigitValidator)->validate($number->reveal())
        );
    }

    public function testUnexpectedClearingCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingCheckDigit()->willReturn('5');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new NoClearingCheckDigitValidator)->validate($number->reveal())
        );
    }

    public function testUnexpectedClearingCheckDigitCero()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingCheckDigit()->willReturn('0');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new NoClearingCheckDigitValidator)->validate($number->reveal())
        );
    }
}
