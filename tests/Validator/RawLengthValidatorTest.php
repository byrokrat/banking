<?php

namespace byrokrat\banking\Validator;

class RawLengthValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testValidLength()
    {
        $number = $this->getMockBuilder('byrokrat\banking\AccountNumber')->getMock();

        $number->expects($this->any())
            ->method('getRawNumber')
            ->will($this->returnValue(' 1-2, 34'));

        $this->assertNull((new RawLengthValidator(4))->validate($number));
    }

    public function testExceptionOnInvalidLength()
    {
        $number = $this->getMockBuilder('byrokrat\banking\AccountNumber')->getMock();

        $number->expects($this->any())
            ->method('getRawNumber')
            ->will($this->returnValue('1234,5'));

        $this->expectException('byrokrat\banking\Exception\InvalidStructureException');
        (new RawLengthValidator(4))->validate($number);
    }
}
