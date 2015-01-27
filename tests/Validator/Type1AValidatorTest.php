<?php

namespace byrokrat\banking\Validator;

class Type1AValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $number = $this->getMock('byrokrat\banking\AccountNumber');
        $number->expects($this->once())
            ->method('getClearingNumber')
            ->will($this->returnValue('1234'));
        $number->expects($this->once())
            ->method('getSerialNumber')
            ->will($this->returnValue('123456'));
        $number->expects($this->once())
            ->method('getCheckDigit')
            ->will($this->returnValue('7'));

        $checksum = $this->getMock('byrokrat\checkdigit\Modulo11');
        $checksum->expects($this->once())
            ->method('isValid')
            ->with('2341234567')
            ->will($this->returnValue(true));

        $validator = new Type1AValidator($checksum);

        $validator->validate($number);
    }
}
