<?php

namespace byrokrat\banking\Validator;

class LengthValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidLength()
    {
        $number = $this->getMock('byrokrat\banking\AccountNumber');

        $number->expects($this->any())
            ->method('getRawNumber')
            ->will($this->returnValue(' 1-2, 34'));

        $this->assertNull((new LengthValidator(4))->validate($number));
    }

    public function testExceptionOnInvalidLength()
    {
        $number = $this->getMock('byrokrat\banking\AccountNumber');

        $number->expects($this->any())
            ->method('getRawNumber')
            ->will($this->returnValue('1234,45'));

        $this->setExpectedException('byrokrat\banking\Exception\InvalidAccountNumberException');
        (new LengthValidator(4))->validate($number);
    }
}
