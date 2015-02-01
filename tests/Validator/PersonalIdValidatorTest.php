<?php

namespace byrokrat\banking\Validator;

class PersonalIdValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidPersonalId()
    {
        $number = $this->getMock('byrokrat\banking\AccountNumber');

        $number->expects($this->any())
            ->method('getSerialNumber')
            ->will($this->returnValue('841128394'));

        $number->expects($this->any())
            ->method('getCheckDigit')
            ->will($this->returnValue('1'));

        $this->assertNull((new PersonalIdValidator)->validate($number));
    }

    public function testExceptionOnInvalidCheckDigit()
    {
        $number = $this->getMock('byrokrat\banking\AccountNumber');

        $number->expects($this->any())
            ->method('getSerialNumber')
            ->will($this->returnValue('841128394'));

        $number->expects($this->any())
            ->method('getCheckDigit')
            ->will($this->returnValue('2'));

        $this->setExpectedException('byrokrat\banking\Exception\InvalidCheckDigitException');
        (new PersonalIdValidator)->validate($number);
    }

    public function testExceptionOnInvalidDate()
    {
        $number = $this->getMock('byrokrat\banking\AccountNumber');

        $number->expects($this->any())
            ->method('getSerialNumber')
            ->will($this->returnValue('841328394'));

        $number->expects($this->any())
            ->method('getCheckDigit')
            ->will($this->returnValue('9'));

        $this->setExpectedException('byrokrat\banking\Exception\InvalidAccountNumberException');
        (new PersonalIdValidator)->validate($number);
    }
}
