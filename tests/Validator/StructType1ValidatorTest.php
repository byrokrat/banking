<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class StructType1ValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testValidLength()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('123456');

        $this->assertInstanceOf(
            Success::CLASS,
            (new StructType1Validator)->validate($number->reveal())
        );
    }

    public function testToShortLength()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new StructType1Validator)->validate($number->reveal())
        );
    }

    public function testToLongLength()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('1234567');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new StructType1Validator)->validate($number->reveal())
        );
    }
}
