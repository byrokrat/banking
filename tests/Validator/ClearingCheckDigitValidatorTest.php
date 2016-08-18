<?php

namespace byrokrat\banking\Validator;

class ClearingCheckDigitValidatorTest extends ValidatorTestCase
{
    public function testValidCheckDigit()
    {
        $checksum = $this->getMockBuilder('byrokrat\checkdigit\Modulo10')->getMock();
        $checksum->expects($this->once())
            ->method('isValid')
            ->with('12345')
            ->will($this->returnValue(true));

        $this->assertNull((new ClearingCheckDigitValidator($checksum))->validate(
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
        (new ClearingCheckDigitValidator($checksum))->validate(
            $this->getAccountNumberMock()
        );
    }

    public function testIgnoreUnspecifiedCheckDigit()
    {
        $this->assertNull(
            (new ClearingCheckDigitValidator($this->getMockBuilder('byrokrat\checkdigit\Modulo10')->getMock()))->validate(
                $this->getMockBuilder('byrokrat\banking\AccountNumber')->getMock()
            )
        );
    }
}
