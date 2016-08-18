<?php

namespace byrokrat\banking\Validator;

class CheckDigitType2ValidatorTest extends ValidatorTestCase
{
    public function testValidCheckDigit()
    {
        $checksum = $this->getMockBuilder('byrokrat\checkdigit\Modulo10')->getMock();
        $checksum->expects($this->once())
            ->method('isValid')
            ->with('1234567')
            ->will($this->returnValue(true));

        $this->assertNull((new CheckDigitType2Validator($checksum))->validate(
            $this->getAccountNumberMock()
        ));
    }

    public function testExceptionOnInvalidCheckDigit()
    {
        $checksum = $this->getMockBuilder('byrokrat\checkdigit\Modulo10')->getMock();
        $checksum->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->setExpectedException('byrokrat\banking\Exception\InvalidCheckDigitException');
        (new CheckDigitType2Validator($checksum))->validate(
            $this->getAccountNumberMock()
        );
    }
}
