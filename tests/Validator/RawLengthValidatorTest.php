<?php

namespace byrokrat\banking\Validator;

class RawLengthValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidLength()
    {
        $number = $this->getMock('byrokrat\banking\AccountNumber');

        $number->expects($this->any())
            ->method('getRawNumber')
            ->will($this->returnValue(' 1-2, 34'));

        $this->assertNull((new RawLengthValidator(4))->validate($number));
    }

    public function testExceptionOnInvalidLength()
    {
        $number = $this->getMock('byrokrat\banking\AccountNumber');

        $number->expects($this->any())
            ->method('getRawNumber')
            ->will($this->returnValue('1234,5'));

        $this->setExpectedException('byrokrat\banking\Exception\InvalidStructureException');
        (new RawLengthValidator(4))->validate($number);
    }
}
