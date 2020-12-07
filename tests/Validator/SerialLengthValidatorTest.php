<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class SerialLengthValidatorTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testValidLength()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('123');

        $this->assertInstanceOf(
            Success::CLASS,
            (new SerialLengthValidator(3, 3))->validate($number->reveal())
        );
    }

    public function testToShortLength()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('12');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new SerialLengthValidator(3, 3))->validate($number->reveal())
        );
    }

    public function testToLongLength()
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getSerialNumber()->willReturn('1234');

        $this->assertInstanceOf(
            Failure::CLASS,
            (new SerialLengthValidator(3, 3))->validate($number->reveal())
        );
    }
}
