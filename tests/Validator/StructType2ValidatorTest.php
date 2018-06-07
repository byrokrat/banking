<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class StructType2ValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testValidLength()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('123');

        $this->assertInstanceOf(
            Success::CLASS,
            (new StructType2Validator)->validate($number->reveal())
        );
    }

    public function testToShortLength()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new StructType2Validator)->validate($number->reveal())
        );
    }

    public function testToLongLength()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('1234567890');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new StructType2Validator)->validate($number->reveal())
        );
    }
}
