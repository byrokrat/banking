<?php

namespace byrokrat\banking\Validator;

class CheckDigitHandelsbankenValidatorTest extends ValidatorTestCase
{
    public function testValidCheckDigit()
    {
        $checksum = $this->getMockBuilder('byrokrat\checkdigit\Modulo11')->getMock();
        $checksum->expects($this->once())
            ->method('isValid')
            ->with('1234567')
            ->will($this->returnValue(true));

        $this->assertNull((new CheckDigitHandelsbankenValidator($checksum))->validate(
            $this->getAccountNumberMock()
        ));
    }

    public function testExceptionOnInvalidCheckDigit()
    {
        $checksum = $this->getMockBuilder('byrokrat\checkdigit\Modulo11')->getMock();
        $checksum->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->setExpectedException('byrokrat\banking\Exception\InvalidCheckDigitException');
        (new CheckDigitHandelsbankenValidator($checksum))->validate(
            $this->getAccountNumberMock()
        );
    }
}
