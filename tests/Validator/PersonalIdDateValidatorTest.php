<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class PersonalIdDateValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testValidPersonalId()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('841128394');
        $number->getCheckDigit()->willReturn('1');

        $this->assertInstanceOf(
            Success::CLASS,
            (new PersonalIdDateValidator)->validate($number->reveal())
        );
    }

    public function testInvalidDate()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('841328394');
        $number->getCheckDigit()->willReturn('9');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new PersonalIdDateValidator)->validate($number->reveal())
        );
    }
}
