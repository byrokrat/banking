<?php

namespace byrokrat\banking\Validator;

class CheckDigitType1BValidatorTest extends ValidatorTestCase
{
    public function testValidCheckDigit()
    {
        $checksum = $this->getMock('byrokrat\checkdigit\Modulo11');
        $checksum->expects($this->once())
            ->method('isValid')
            ->with('12341234567')
            ->will($this->returnValue(true));

        $this->assertNull((new CheckDigitType1BValidator($checksum))->validate(
            $this->getAccountNumberMock()
        ));
    }

    public function testExceptionOnInvalidCheckDigit()
    {
        $checksum = $this->getMock('byrokrat\checkdigit\Modulo11');
        $checksum->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->setExpectedException('byrokrat\banking\Exception\InvalidCheckDigitException');
        (new CheckDigitType1BValidator($checksum))->validate(
            $this->getAccountNumberMock()
        );
    }
}
